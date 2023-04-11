<?php

declare(strict_types=1);
require_once("documentFile.php");
/**
 * ファイルアップローダのクラス
 * 
 * @param file $documentFile : アップロードされる予定のファイル
 */

class Uploader
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function upload()
    {
        $fileName = $this->file["name"];
        $tempName = $this->file["tmp_name"];
        $size = $this->file["size"];
        $errorCode = $this->file["error"];
        $documentFile = new DocumentFile($fileName, $tempName, $size, $errorCode);

        // ファイルの拡張子チェック
        $documentFile->extensionCheck();
        // ファイルのエラーチェック
        $documentFile->errorCheck();
        // ファイルのサイズチェック
        $documentFile->sizeCheck();
        // ファイルを適切な場所に移動
        $documentFile->move();
    }
}
