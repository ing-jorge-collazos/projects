Public Class mnu_principal

    Private Sub Panel1_Click(sender As Object, e As System.EventArgs) Handles MenuVertical.Click
        If (MenuVertical.Width = 250) Then
            MenuVertical.Width = 70
        Else
            MenuVertical.Width = 250
        End If
    End Sub
    Private Sub mnu_principal_Load(sender As System.Object, e As System.EventArgs) Handles MyBase.Load
        ' Call desconectar()
        txt_idusuarios.Text = GFAOS_Login.txt_id_user.Text
        AbrirFormPanel(principal_inicio)
    End Sub
    Public Sub AbrirFormPanel(ByVal Formhijo As Object)
        If Me.panelContenedor.Controls.Count > 0 Then
            Me.panelContenedor.Controls.RemoveAt(0)
        End If
        Dim fh As Form = TryCast(Formhijo, Form)
        fh.TopLevel = False
        fh.FormBorderStyle = Windows.Forms.FormBorderStyle.None
        fh.Dock = DockStyle.Fill
        Me.panelContenedor.Controls.Add(fh)
        Me.panelContenedor.Tag = fh
        fh.Show()
    End Sub
    Private Sub Button8_Click(sender As System.Object, e As System.EventArgs) Handles Button8.Click
        AbrirFormPanel(principal_inicio)
    End Sub

    Private Sub btn_psicosocial_Click(sender As System.Object, e As System.EventArgs) Handles btn_psicosocial.Click
        AbrirFormPanel(GFAOS_psicosocial)
    End Sub

    Private Sub Button2_Click(sender As System.Object, e As System.EventArgs) Handles Button2.Click
        AbrirFormPanel(GFAOS_psicosocial)
    End Sub

    Private Sub MenuVertical_Paint(sender As System.Object, e As System.Windows.Forms.PaintEventArgs) Handles MenuVertical.Paint

    End Sub

    Private Sub Button1_Click(sender As System.Object, e As System.EventArgs) Handles Button1.Click
        AbrirFormPanel(ruta_metodologica)
    End Sub
End Class


