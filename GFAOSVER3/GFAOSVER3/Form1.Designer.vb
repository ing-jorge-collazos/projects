<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form1
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Form1))
        Me.txt_codigo = New System.Windows.Forms.TextBox()
        Me.txt_nombre = New System.Windows.Forms.TextBox()
        Me.ArcPDF = New AxAcroPDFLib.AxAcroPDF()
        Me.Button1 = New System.Windows.Forms.Button()
        Me.Button2 = New System.Windows.Forms.Button()
        Me.Button3 = New System.Windows.Forms.Button()
        Me.txt_ruta = New System.Windows.Forms.TextBox()
        CType(Me.ArcPDF, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
        '
        'txt_codigo
        '
        Me.txt_codigo.Location = New System.Drawing.Point(136, 33)
        Me.txt_codigo.Name = "txt_codigo"
        Me.txt_codigo.Size = New System.Drawing.Size(100, 22)
        Me.txt_codigo.TabIndex = 0
        '
        'txt_nombre
        '
        Me.txt_nombre.Location = New System.Drawing.Point(136, 61)
        Me.txt_nombre.Name = "txt_nombre"
        Me.txt_nombre.Size = New System.Drawing.Size(100, 22)
        Me.txt_nombre.TabIndex = 1
        '
        'ArcPDF
        '
        Me.ArcPDF.Enabled = True
        Me.ArcPDF.Location = New System.Drawing.Point(274, 33)
        Me.ArcPDF.Name = "ArcPDF"
        Me.ArcPDF.OcxState = CType(resources.GetObject("ArcPDF.OcxState"), System.Windows.Forms.AxHost.State)
        Me.ArcPDF.Size = New System.Drawing.Size(667, 460)
        Me.ArcPDF.TabIndex = 2
        '
        'Button1
        '
        Me.Button1.Location = New System.Drawing.Point(161, 255)
        Me.Button1.Name = "Button1"
        Me.Button1.Size = New System.Drawing.Size(75, 23)
        Me.Button1.TabIndex = 3
        Me.Button1.Text = "Cargar"
        Me.Button1.UseVisualStyleBackColor = True
        '
        'Button2
        '
        Me.Button2.Location = New System.Drawing.Point(161, 284)
        Me.Button2.Name = "Button2"
        Me.Button2.Size = New System.Drawing.Size(75, 23)
        Me.Button2.TabIndex = 4
        Me.Button2.Text = "Grabar"
        Me.Button2.UseVisualStyleBackColor = True
        '
        'Button3
        '
        Me.Button3.Location = New System.Drawing.Point(161, 314)
        Me.Button3.Name = "Button3"
        Me.Button3.Size = New System.Drawing.Size(75, 23)
        Me.Button3.TabIndex = 5
        Me.Button3.Text = "Recuperar"
        Me.Button3.UseVisualStyleBackColor = True
        '
        'txt_ruta
        '
        Me.txt_ruta.Location = New System.Drawing.Point(136, 89)
        Me.txt_ruta.Name = "txt_ruta"
        Me.txt_ruta.Size = New System.Drawing.Size(100, 22)
        Me.txt_ruta.TabIndex = 6
        '
        'Form1
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(8.0!, 16.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(953, 540)
        Me.Controls.Add(Me.txt_ruta)
        Me.Controls.Add(Me.Button3)
        Me.Controls.Add(Me.Button2)
        Me.Controls.Add(Me.Button1)
        Me.Controls.Add(Me.ArcPDF)
        Me.Controls.Add(Me.txt_nombre)
        Me.Controls.Add(Me.txt_codigo)
        Me.Name = "Form1"
        Me.Text = "Form1"
        CType(Me.ArcPDF, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents txt_codigo As System.Windows.Forms.TextBox
    Friend WithEvents txt_nombre As System.Windows.Forms.TextBox
    Friend WithEvents ArcPDF As AxAcroPDFLib.AxAcroPDF
    Friend WithEvents Button1 As System.Windows.Forms.Button
    Friend WithEvents Button2 As System.Windows.Forms.Button
    Friend WithEvents Button3 As System.Windows.Forms.Button
    Friend WithEvents txt_ruta As System.Windows.Forms.TextBox

End Class
