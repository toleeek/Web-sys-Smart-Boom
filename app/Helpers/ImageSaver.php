<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageSaver {
    /**
     * Зберігає зображення при створенні чи редагуванні категорії,
     * бренда чи товара; створює два зменшених зображення.
     *
     * @param \Illuminate\Http\Request $request — обект HTTP-запроса
     * @param \App\Models\Item $item — модель категорії, бренда чи товара
     * @param string $dir — директорія, куда будем зберігати зображення
     * @return string|null — імя файла зображення
     */
    public function upload($request, $item, $dir) {
        $name = $item->image ?? null;
        if ($item && $request->remove) {
            $this->remove($item, $dir);
            $name = null;
        }
        $source = $request->file('image');
        if ($source) {

            if ($item && $item->image) {
                $this->remove($item, $dir);
            }
            $ext = $source->extension();

            $path = $source->store('catalog/'.$dir.'/source', 'public');
            $path = Storage::disk('public')->path($path); // абсолютный путь
            $name = basename($path); // имя файла

            $dst = 'catalog/'.$dir.'/image/';
            $this->resize($path, $dst, 600, 300, $ext);

            $dst = 'catalog/'.$dir.'/thumb/';
            $this->resize($path, $dst, 300, 150, $ext);
        }
        return $name;
    }

    /**
     * Створює зменшену копію зображення
     *
     * @param string $src — шлях до ісходніка зображення
     * @param string $dst — місце збереження збереженого фото
     * @param integer $width — ширина в пікселях
     * @param integer $height — висота в пікселях
     * @param string $ext — разширення зменшеного фото
     */
    private function resize($src, $dst, $width, $height, $ext) {

        $image = Image::make($src)
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee')
            ->encode($ext, 100);

        $name = basename($src);
        Storage::disk('public')->put($dst . $name, $image);
        $image->destroy();
    }

    /**
     * УВидаляє зображення при видаленні категорії, бренда чи товара
     *
     * @param \App\Models\Item $item — модель категорії, бренда чи товара
     * @param string $dir — директорія, в якій знаходиться зображення
     */
    public function remove($item, $dir) {
        $old = $item->image;
        if ($old) {
            Storage::disk('public')->delete('catalog/'.$dir.'/source/' . $old);
            Storage::disk('public')->delete('catalog/'.$dir.'/image/' . $old);
            Storage::disk('public')->delete('catalog/'.$dir.'/thumb/' . $old);
        }
    }
}
