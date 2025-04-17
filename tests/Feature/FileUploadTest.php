<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses (RefreshDatabase::class);

test('PNG image can be uploaded, without password protection', function () {


    Storage::fake('uploads');
    $image = UploadedFile::fake()->image('test.png', 100, 100);

    $response = $this->post('/upload', [
        'file' => $image
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});


test('PNG image can be uploaded, with password protection', function () {


    Storage::fake('uploads');
    $image = UploadedFile::fake()->image('test.png', 100, 100);
    $password = fake()->password();

    $response = $this->post('/upload', [
        'file' => $image,
        'password' => $password
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);


});

test('JPG image can be uploaded, without password protection', function () {


    Storage::fake('uploads');
    $image = UploadedFile::fake()->image('test.jpg', 100, 100);

    $response = $this->post('/upload', [
        'file' => $image
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);


});


test('JPG image can be uploaded, with password protection', function () {


    Storage::fake('uploads');
    $image = UploadedFile::fake()->image('test.jpg', 100, 100);
    $password = fake()->password();

    $response = $this->post('/upload', [
        'file' => $image,
        'password' => $password
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});

test('JPEG image can be uploaded, without password protection', function () {


    Storage::fake('uploads');
    $image = UploadedFile::fake()->image('test.jpeg', 100, 100);

    $response = $this->post('/upload', [
        'file' => $image
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});


test('JPEG image can be uploaded, with password protection', function () {


    Storage::fake('uploads');
    $image = UploadedFile::fake()->image('test.jpeg', 100, 100);
    $password = fake()->password();

    $response = $this->post('/upload', [
        'file' => $image,
        'password' => $password
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});

test('ZIP files can be uploaded, without password protection', function () {


    Storage::fake('uploads');
    $zip = UploadedFile::fake()->create('test.zip', 500, 'application/zip');

    $response = $this->post('/upload', [
        'file' => $zip
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});


test('ZIP files can be uploaded, with password protection', function () {


    Storage::fake('uploads');
    $zip = UploadedFile::fake()->create('test.zip', 500, 'application/zip');

    $password = fake()->password();

    $response = $this->post('/upload', [
        'file' => $zip,
        'password' => $password
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});

test('TXT files can be uploaded, without password protection', function () {


    Storage::fake('uploads');
    $txt = UploadedFile::fake()->create('test.txt', 500, 'text/plain');

    $response = $this->post('/upload', [
        'file' => $txt
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});


test('TXT files can be uploaded, with password protection', function () {


    Storage::fake('uploads');
    $txt = UploadedFile::fake()->create('test.txt', 500, 'text/plain');

    $password = fake()->password();

    $response = $this->post('/upload', [
        'file' => $txt,
        'password' => $password
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);

});

test('PDF file can be uploaded, without password protection', function () {
    Storage::fake('uploads');
    $pdf = UploadedFile::fake()->create('test.pdf', 500, 'application/pdf');

    $response = $this->post('/upload', [
        'file' => $pdf,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);
});


test('PDF file can be uploaded, with password protection', function () {
    Storage::fake('uploads');
    $pdf = UploadedFile::fake()->create('test.pdf', 500, 'application/pdf');

    $password = fake()->password();

    $response = $this->post('/upload', [
        'file' => $pdf,
        'password' => $password,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseCount('files', 1);
});


test('Too large file uploads will be blocked', function () {

    Storage::fake('uploads');
    $image = UploadedFile::fake()->image('test.png', 100, 100)->size(10241); // Limit is 10240 KB = 10 MB

    $response = $this->post('/upload', [
        'file' => $image,
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseCount('files', 0);

});
