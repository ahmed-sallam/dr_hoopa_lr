<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Course;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class CourseForm extends Form
{
    use WithFileUploads;

    public ?Course $course = null;
    public string $title = '';
    public string $sub_title = '';
    public string $description = '';
    public  $price = 0;
    public  $discount = 0;
    public  $net_price = 0;
    public $thumbnail = '';
    public string $featured_video = '';
    public string $status = 'inactive';
    public array $data = []; // This will store our dynamic data
    public ?int $parent_id = null;

    // New properties for dynamic data input
    public string $newDataSvg = '';
    public string $newDataTitle = '';
    public string $newDataLink = '';

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'featured_video' => 'nullable|string|url',
            'status' => 'required|in:active,inactive',
            'data' => 'nullable|array',
            'parent_id' => 'nullable|exists:courses,id',
            'data.*.svg' => 'required|string',
            'data.*.title' => 'required|string',
            'data.*.link' => 'required|string|url',
            'newDataSvg' => 'nullable|string',
            'newDataTitle' => 'nullable|string',
            'newDataLink' => 'nullable|string|url',
        ];
    }

    public function setCourse(Course $course)
    {
        $this->course = $course;
        $this->title = $course->title;
        $this->sub_title = $course->sub_title;
        $this->description = $course->description;
        $this->price = $course->price;
        $this->discount = $course->discount;
        $this->net_price = $course->net_price;
        $this->thumbnail = $course->thumbnail;
        $this->featured_video = $course->featured_video;
        $this->status = $course->status;
        $this->data = is_string($course->data) ? json_decode($course->data, true) : $course->data ?? [];
        $this->parent_id = $course->parent_id;
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

        $this->course = Course::create($data);
    }

    public function update()
    {
        // Determine if thumbnail is a file upload
        $thumbnailIsFile = $this->thumbnail && !is_string($this->thumbnail);

        // Define base validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'featured_video' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'data' => 'nullable|array',
            'parent_id' => 'nullable|exists:courses,id',
            'data.*.svg' => 'required|string',
            'data.*.title' => 'required|string',
            'data.*.link' => 'required|string',
            'newDataSvg' => 'nullable|string',
            'newDataTitle' => 'nullable|string',
            'newDataLink' => 'nullable|string|url',
        ];

        // Add thumbnail validation rule if it's a file upload
        if ($thumbnailIsFile) {
            $rules['thumbnail'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        // Validate the data
        $this->validate($rules);

        $data = $this->all();

        // Handle file upload for thumbnail
        if ($thumbnailIsFile) {
            $data['thumbnail'] = $this->thumbnail->store('thumbnails', 'public');
        } else {
            // If thumbnail is a string, use the existing path
            $data['thumbnail'] = $this->course->thumbnail;
        }

        // Ensure data is stored as JSON
        $data['data'] = json_encode($this->data);

        $this->course->update($data);
    }

    public function addDataItem()
    {
        $this->validate([
            'newDataSvg' => 'required|string',
            'newDataTitle' => 'required|string',
            'newDataLink' => 'required|string',
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

    public function resetForm()
    {
        $this->title = '';
        $this->sub_title = '';
        $this->description = '';
        $this->price = 0;
        $this->discount = 0;
        $this->net_price = 0;
        $this->thumbnail = '';
        $this->featured_video = '';
        $this->status = 'inactive';
        $this->data = [];
        $this->parent_id = null;
        $this->newDataSvg = '';
        $this->newDataTitle = '';
        $this->newDataLink = '';
    }
}
