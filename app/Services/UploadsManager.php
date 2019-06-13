<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Dflydev\ApacheMimeTypes\PhpRepository;

class UploadsManager {

    protected $disk;
    protected $mimeDetect;

    public function __construct(PhpRepository $mimeDetect)
    {
        $this->disk = Storage::disk(config('blog.uploads.storage'));
        $this->mimeDetect = $mimeDetect;
    }

    public function folderInfo($folder)
    {
        $folder = $this->cleanFolder($folder);

        $breadcrumbs = $this->breadcrumbs($folder);
        $slice = array_slice($breadcrumbs, -1);
        $folderName = current($slice);
        $breadcrumbs = array_slice($breadcrumbs, 0, -1);

        $subfolders = [];
        foreach (array_unique($this->disk->directories($folder)) as $subfolder) {
            $subfolders["/$subfolder"] = basename($subfolder);
        }

        $files = [];
        foreach ($this->disk->files($folder) as $path) {
            $files[] = $this->fileDetails($path);
        }

        return compact(
                'folder',
                'folderName',
                'breadcrumbs',
                'subfolders',
                'files'
        );

    }

    public function cleanFolder($folder)
    {
        //清理文件夹名称
        return '/' . trim(str_replace('..', '', $folder), '/');
    }

    public function breadcrumbs($folder)
    {
        //返回当前目录路径
        $folder = trim($folder, '/');
        $crumbs = ['/' => 'root'];
        if (empty($folder)) {
            return $crumbs;
        }

        $folders = explode('/', $folder);
        $build = '';
        foreach ($folders as $folder) {
            $build = '/' . $folder;
            $crumbs[$build] = $folder;
        }

        return $crumbs;

    }

    //返回文件详细信息数组
    public function fileDetails($path)
    {
        $path = '/' . trim($path, '/');

        return [
                'name'     => basename($path),
                'fullPath' => $path,
                'webPath'  => $this->fileWebPath($path),
                'mimeType' => $this->fileMimeType($path),
                'size'     => $this->fileSize($path),
                'modified' => $this->fileModified($path),
        ];

    }

    //返回文件完整的 web 路径
    public function fileWebPath($path)
    {
        $path = rtrim(config('blog.uploads.webpath'), '/') . '/' . ltrim($path, '/');
        return url($path);
    }

    //返回文件 MIME 类型
    public function fileMimeType($path)
    {
        return $this->mimeDetect->findType(
                pathinfo($path, PATHINFO_EXTENSION)
        );
    }

    //返回文件大小
    public function fileSize($path)
    {
        return $this->disk->size($path);
    }

    //返回最后修改时间
    public function fileModified($path)
    {
        return Carbon::createFromTimestamp(
                $this->disk->lastModified($path)
        );
    }

    //创建新目录
    public function createDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        if ($this->disk->exists($folder)) {
            return "Folder '$folder' already exists";
        }

        return $this->disk->makeDirectory($folder);
    }

    //删除目录
    public function deleteDirectory($folder)
    {
        $folder = $this->cleanFolder($folder);

        $filesFolders = array_merge(
                $this->disk->directories($folder),
                $this->disk->files($folder)
        );
        if ( ! empty($filesFolders)) {
            return "Directory must be empty delete it";
        }

        return $this->disk->deleteDirectory($folder);
    }

    //删除文件
    public function deleteFile($path)
    {
        $path = $this->cleanFolder($path);

        if ( ! $this->disk->exists($path)) {
            return "File does not exists";
        }

        return $this->disk->delete($path);

    }

    //保存文件
    public function saveFile($path, $content)
    {
        $path = $this->cleanFolder($path);

        if ($this->disk->exists($path)) {
            return "File already exists.";
        }

        return $this->disk->put($path, $content);
    }

}