<?php

namespace App\Http\Controllers\Admin\Notify\Email;

use Illuminate\Http\Request;
use App\Models\Admin\Notify\Email;
use App\Http\Controllers\Controller;
use App\Models\Admin\Notify\EmailFile;
use App\Http\Services\FileBuilder\UploadFile;
use App\Http\Requests\Admin\Notify\EmailFileRequest;
use App\Http\Services\FileBuilder\UploadFile as FileBuilder;

class EmailFileController extends Controller
{
    public function index(Email $email)
    {
        return view("admin.notify.email.email-file.index" , compact("email"));
    }

    public function create(Email $email)
    {
        return view("admin.notify.email.email-file.create" , compact("email"));
    }

    public function store(Email $email , EmailFileRequest $request , UploadFile $uploadFile)
    {
        $inputs = $request->all();
        $inputs["file_size"] = $request->file("file")->getSize();
        $inputs["public_email_id"] = $email->id;
        $filePath = FileBuilder::setFile($inputs["file"])->setExclusiveDirectory("fileTest" . DIRECTORY_SEPARATOR . "email")->upload(true);
        $inputs["file_path"] = $filePath;
        $inputs["file_type"] = $uploadFile->getFileFormat();
        EmailFile::create($inputs);
        return redirect()->route("admin.notify.email.all-files.index" , $email->id)->with(["success" => "فایل ضمیمیه ی شما به درستی بر روی ایمیل قرار گرفت"]);
    }

    public function edit( Email $email , EmailFile $file)
    {
        return view("admin.notify.email.email-file.edit" , compact("file" , "email"));
    }

    public function update(Email $email , EmailFile $file , EmailFileRequest $request , UploadFile $uploadFile)
    {
        $inputs = $request->all();
        if($request->file("file")){
            $inputs["file_size"] = $request->file("file")->getSize();
            $uploadFile->setExclusiveDirectory("file" . DIRECTORY_SEPARATOR . "email");
            $filePath = $uploadFile->upload($request->file("file"));
            $inputs["file_path"] = $filePath;
            $inputs["file_type"] = $uploadFile->getFileFormat();
            $uploadFile->deleteFile($file->file_path);
        }
        $file->update($inputs);
        $file->save();
        return redirect()->route("admin.notify.email.all-files.index" , $email->id)->with(["success" => "فایل ضمیمیه ی شما به درستی بروز رسانی شد"]);
    }
}
