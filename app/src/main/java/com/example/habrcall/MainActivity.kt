package com.example.habrcall; //замените habrcall на название вашего проекта

import android.content.Intent
import android.net.Uri
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.TextView


class MainActivity: AppCompatActivity() {
    private var clickCount = 1

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        var buttonCall = findViewById<Button>(R.id.button_call)
        var textViewCall = findViewById<TextView>(R.id.text_call)
        buttonCall.setOnClickListener {
            // звонок на разные добавочные (номер выдуман)
            val dialIntent = Intent(Intent.ACTION_DIAL)
            dialIntent.data = Uri.parse("tel:+79000000001;000$clickCount")
            startActivity(dialIntent)
            clickCount++
            // измененеи текста в зависимости от этапа обработки заказа.y
            when (clickCount) {
                2 -> {
                    textViewCall.text="Заказ комплектуется"
                    buttonCall.text="Позвонить кладовщику"
                }
                3 -> {
                    textViewCall.text="Заказ комплектуется"
                    buttonCall.text="Позвонить курьеру"
                }
                else ->
                {
                    clickCount = 1 // reset count
                    textViewCall.text="Сделать или уточнить заказ"
                    buttonCall.text="Позвонить менеджеру"
                }
            }

        }
    }
}