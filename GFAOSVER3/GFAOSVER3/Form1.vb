Imports System.Data.SqlClient
Imports System.IO


Public Class Form1

    Private Sub Button1_Click(sender As System.Object, e As System.EventArgs) Handles Button1.Click
        Try
            Dim archivo As New OpenFileDialog
            archivo.Filter = "Archivo PDF|*.pdf"
            If archivo.ShowDialog = DialogResult.OK Then
                txt_ruta.Text = archivo.FileName
                ArcPDF.src = archivo.FileName
            End If
        Catch ex As Exception
            MsgBox(ex.Message)
        End Try
    End Sub

    Private Sub Button2_Click(sender As System.Object, e As System.EventArgs) Handles Button2.Click
        Try
            Dim strPath As String
            strPath = txt_ruta.Text
            Dim ruta As New FileStream(strPath, FileMode.Open, FileAccess.Read)
            Dim binario(ruta.Length) As Byte
            ruta.Read(binario, 0, ruta.Length) 'Leo el archivo y lo convierto a binario 
            ruta.Close() 'Cierro el FileStream 

            Dim cnn As New SqlConnection(str_conexion)
            Dim cmm As New SqlCommand("sp_mant_archivo", cnn)
            cmm.CommandType = CommandType.StoredProcedure
            cmm.Parameters.AddWithValue("@id", txt_codigo.Text)
            cmm.Parameters.AddWithValue("@nombre", txt_nombre.Text)
            cmm.Parameters.AddWithValue("@archivo", binario)
            'ejecutar
            Try
                cnn.Open()
                cmm.ExecuteNonQuery()
            Catch ex As Exception
                MsgBox(ex.Message)
            Finally
                cnn.Dispose()
                cmm.Dispose()
            End Try
        Catch ex As Exception

        End Try
    End Sub

    Private Sub Button3_Click(sender As System.Object, e As System.EventArgs) Handles Button3.Click
        Try
            Dim directorioArchivo As String
            directorioArchivo = System.AppDomain.CurrentDomain.BaseDirectory() & "temp.pdf"

            Dim str_cadena As String
            str_cadena = " select * from tb_psi where id=" & txt_codigo.Text
            If Conectar() = False Then
                Exit Sub
            End If
            dr = Fun_ExecuteReader(str_cadena)
            If dr.HasRows Then
                While dr.Read
                    txt_codigo.Text = dr("id")
                    txt_nombre.Text = dr("nombre")
                    If dr("archivo") IsNot DBNull.Value Then
                        Dim bytes() As Byte
                        bytes = dr("archivo")

                        BytesAArchivo(bytes, directorioArchivo)
                        ArcPDF.src = directorioArchivo

                        My.Computer.FileSystem.DeleteFile(directorioArchivo)
                    End If
                End While
            End If
        Catch ex As Exception
            MsgBox(ex.Message)
        End Try
    End Sub

    Private Sub BytesAArchivo(ByVal bytes() As Byte, ByVal Path As String)
        Dim K As Long
        If bytes Is Nothing Then Exit Sub
        Try
            K = UBound(bytes)
            Dim fs As New FileStream(Path, FileMode.OpenOrCreate, FileAccess.Write)
            fs.Write(bytes, 0, K)
            fs.Close()
        Catch ex As Exception
            Throw New Exception(ex.Message, ex)
        End Try
    End Sub
End Class
