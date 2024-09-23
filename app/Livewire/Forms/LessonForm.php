<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Lesson;
use Livewire\Attributes\Validate;

class LessonForm extends Form
{
    public ?Lesson $lesson = null;
    public  string $title = '';
    public string $sub_title = '';
    public string $description = '';
    public bool $is_premium = true;
    public  $thumbnail = '';
    public string $content_url = '';
    public string $status = 'active';
    public int $order = 0;
    public array $data = [];
    public ?int $course_id = null;
    public string $content_type = 'video';

    public string $newDataSvg = '';
    public string $newDataTitle = '';
    public string $newDataLink = '';

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_premium' => 'required|boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content_url' => 'required|string|url',
            'status' => 'required|in:active,inactive',
            'order' => 'required|integer',
            'data' => 'nullable|array',
            'course_id' => 'nullable|exists:courses,id',
            'content_type' => 'required|in:video,quiz,item',
            'data.*.svg' => 'required|string',
            'data.*.title' => 'required|string',
            'data.*.link' => 'required|string|url',
            'newDataSvg' => 'nullable|string',
            'newDataTitle' => 'nullable|string',
            'newDataLink' => 'nullable|string|url',
        ];
    }

    public function setLesson(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->title = $lesson->title;
        $this->sub_title = $lesson->sub_title;
        $this->description = $lesson->description;
        $this->is_premium = $lesson->is_premium;
        $this->thumbnail = $lesson->thumbnail;
        $this->content_url = $lesson->content_url;
        $this->status = $lesson->status;
        $this->order = $lesson->order;
        $this->data = is_string($lesson->data) ? json_decode($lesson->data, true) : $lesson->data ?? [];
        $this->course_id = $lesson->course_id;
        $this->content_type = $lesson->content_type;
    }

    public function addNewData()
    {
        $this->validate([
            'newDataSvg' => 'required|string',
            'newDataTitle' => 'required|string',
            'newDataLink' => 'required|string|url',
        ]);

        $this->data[] = [
            'svg' => $this->newDataSvg,
            'title' => $this->newDataTitle,
            'link' => $this->newDataLink,
        ];

        // Reset input fields
        $this->newDataSvg = '';
        $this->newDataTitle = '';
        $this->newDataLink = '';
    }
    public function removeDataItem($index)
    {
        unset($this->data[$index]);
        $this->data = array_values($this->data); // Re-index the array
    }
    public function save()
    {
        $this->validate();
        $data = $this->all();

        if ($this->thumbnail && !is_string($this->thumbnail)) {
            $data['thumbnail'] = $this->thumbnail->store('thumbnails', 'public');
        }
        // Ensure data is stored as JSON
        $data['data'] = json_encode($this->data);

        $this->lesson = Lesson::create($data);
    }

    public function update()
    {
        $thumbnailIsFile = $this->thumbnail && !is_string($this->thumbnail);

        $rules = [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'is_premium' => 'required|boolean',
            'content_url' => 'nullable|string|url',
            'status' => 'required|in:active,inactive',
            'order' => 'required|integer',
            'data' => 'nullable|array',
            'course_id' => 'nullable|exists:courses,id',
            'content_type' => 'required|in:video,quiz,item',
            'data.*.svg' => 'required|string',
            'data.*.title' => 'required|string',
            'data.*.link' => 'required|string|url',
            'newDataSvg' => 'nullable|string',
            'newDataTitle' => 'nullable|string',
            'newDataLink' => 'nullable|string|url',
        ];
        if ($thumbnailIsFile) {
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $this->validate($rules);

        $data = $this->all();

        // Handle file upload for thumbnail
        if ($thumbnailIsFile) {
            $data['thumbnail'] = $this->thumbnail->store('thumbnails', 'public');
        } else {
            // If thumbnail is a string, use the existing path
            $data['thumbnail'] = $this->lesson->thumbnail;
        }

        // Ensure data is stored as JSON
        $data['data'] = json_encode($this->data);

        $this->lesson->update($data);
    }

    public function resetForm()
    {
        $this->reset();
        $this->lesson = new Lesson;
        $this->data = [];
    }
}
