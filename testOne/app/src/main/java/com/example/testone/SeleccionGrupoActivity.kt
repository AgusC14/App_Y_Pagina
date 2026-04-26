package com.example.testone

import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView

class SeleccionGrupoActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_seleccion_grupo)

        // 1. ACTIVAR BOTÓN VOLVER
        // Esto pone la flechita en la barra de arriba
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        // 2. RECIBIR EL TIPO DE BICI
        // Leemos lo que mandó el MainActivity ("MTB" o "RUTA")
        val tipoBici = intent.getStringExtra("TIPO_BICI") ?: "MTB"

        // Cambiamos el título de la barra según la elección
        supportActionBar?.title = "Grupos de $tipoBici"

        // 3. DEFINIR LA LISTA SEGÚN EL TIPO
        val listaDeGrupos = if (tipoBici == "MTB") {
            listOf(
                GrupoBici("Shimano Deore", R.mipmap.ic_launcher),
                GrupoBici("Shimano Alivio", R.mipmap.ic_launcher),
                GrupoBici("Shimano SLX", R.mipmap.ic_launcher),
                GrupoBici("Shimano XT", R.mipmap.ic_launcher)
            )
        } else {
            // Aquí agregamos los de RUTA (ejemplos)
            listOf(
                GrupoBici("Shimano Sora", R.mipmap.ic_launcher),
                GrupoBici("Shimano Tiagra", R.mipmap.ic_launcher),
                GrupoBici("Shimano 105", R.mipmap.ic_launcher),
                GrupoBici("Shimano Ultegra", R.mipmap.ic_launcher)
            )
        }

        // 4. CONFIGURAR LA LISTA (RecyclerView)
        val rv = findViewById<RecyclerView>(R.id.rvGrupos)
        rv.layoutManager = LinearLayoutManager(this)
        rv.adapter = GrupoAdapter(listaDeGrupos)
    }

    // 5. HACER QUE LA FLECHA DE VOLVER FUNCIONE
    override fun onSupportNavigateUp(): Boolean {
        onBackPressedDispatcher.onBackPressed() // Esto simula el botón atrás del celu
        return true
    }
}