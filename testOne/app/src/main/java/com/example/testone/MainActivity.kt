package com.example.testone
import android.content.Intent
import android.os.Bundle
import android.widget.Button
import androidx.appcompat.app.AppCompatActivity

class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        // 1. Vinculamos los botones del XML
        val btnRuta = findViewById<Button>(R.id.btnRuta)
        val btnMtb = findViewById<Button>(R.id.btnMtb)

        // 2. Configuración para el botón de MTB
        btnMtb.setOnClickListener {
            val intent = Intent(this, SeleccionGrupoActivity::class.java)
            intent.putExtra("TIPO_BICI", "MTB") // Enviamos la etiqueta MTB
            startActivity(intent)
        }

        // 3. Configuración para el botón de RUTA
        btnRuta.setOnClickListener {
            val intent = Intent(this, SeleccionGrupoActivity::class.java)
            intent.putExtra("TIPO_BICI", "RUTA") // Enviamos la etiqueta RUTA
            startActivity(intent)
        }
    } // Acá cierra el onCreate
} // Acá cierra la clase