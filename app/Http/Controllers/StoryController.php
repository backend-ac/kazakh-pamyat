<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function storeUserStory(Request $request)
    {
        // Валидация
        $request->validate([
            'sender_name' => 'required|max:255',
            'name' => 'required|max:255', // ФИО погибшего
            'user_message' => 'required',  // само сообщение
            'photo' => 'nullable|image|max:2048',
        ]);

        // Создаём новую запись в participants
        $participant = new Participant();

        // Заполняем поля
        $participant->sender_name = $request->input('sender_name');
        $participant->name        = $request->input('name');   // ФИО погибшего
        $participant->user_message = $request->input('user_message');
        $participant->type        = 'user_story'; // указываем, что это пользовательская история

        // Если пользователь прикрепил фото
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('participants', 'public');
            $participant->photo = $path;
        }

        // Сохраняем
        $participant->save();

        // Перенаправляем с сообщением
        return redirect()->back()->with('success', 'Ваша история успешно отправлена!');
    }
}
