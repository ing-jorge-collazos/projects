Imports System.Data.SqlClient

Module publicas
    'variables para conectar
    Dim cnn As SqlConnection
    Dim cmd As SqlCommand
    Public dr As SqlDataReader

    'variables de conexión
    Dim str_servidor As String = "LAPTOP-LC08F1S2\SQLEXPRESS"
    Dim str_Base As String = "DB_gfaos"
    Dim str_usuario As String = "sa"
    Dim str_clave As String = "123456789"
    Public str_conexion As String = "Data Source=" & str_servidor & ";Initial Catalog=" & str_Base & ";User ID=" & str_usuario & ";password=" & str_clave
    Public Function Conectar() As Boolean
        Try
            Conectar = False
            cnn = New SqlConnection
            cnn.ConnectionString = str_conexion
            If cnn.State = ConnectionState.Closed Then
                cnn.Open()
            End If
            Conectar = True
        Catch ex As Exception
            Conectar = False
        End Try
    End Function
    Public Function Desconectar() As Boolean
        Try
            Desconectar = False
            If cnn.State = ConnectionState.Open Then
                cnn.Close()
                Desconectar = True
            End If
        Catch ex As Exception
            Desconectar = False
            MsgBox(ex.Message)
        End Try
    End Function
    Public Function Fun_ExecuteReader(ByVal cadenasql As String, Optional i As Integer = 0) As SqlDataReader
        Try
            cmd = New SqlCommand
            cmd.CommandText = cadenasql
            If i = 0 Then
                cmd.CommandType = CommandType.Text
            Else
                cmd.CommandType = CommandType.StoredProcedure
            End If
            cmd.Connection = cnn
            Return cmd.ExecuteReader()
        Catch ex As Exception
            MsgBox(ex.Message)
            Return Nothing
        End Try
    End Function


End Module
