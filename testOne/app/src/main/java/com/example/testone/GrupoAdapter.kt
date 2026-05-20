package com.example.testone

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView

class GrupoAdapter(private val listaGrupos: List<GrupoBici>) :
    RecyclerView.Adapter<GrupoAdapter.GrupoViewHolder>() {

    // Esta clase representa cada "filita" de tu lista
    class GrupoViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val nombre: TextView = view.findViewById(R.id.txtNombreGrupo)
        val imagen: ImageView = view.findViewById(R.id.imgGrupoItem)
    }

    // Aquí se infla el diseño item_grupo.xml
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): GrupoViewHolder {
        val adapterLayout = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_grupo, parent, false)
        return GrupoViewHolder(adapterLayout)
    }

    // Aquí se le dice qué texto y qué imagen poner a cada fila
    override fun onBindViewHolder(holder: GrupoViewHolder, position: Int) {
        val item = listaGrupos[position]
        holder.nombre.text = item.nombre
        holder.imagen.setImageResource(item.imagenRes)
    }

    override fun getItemCount(): Int = listaGrupos.size
}