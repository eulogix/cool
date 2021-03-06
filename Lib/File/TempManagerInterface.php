<?php

/*
 * This file is part of the Eulogix\Cool package.
 *
 * (c) Eulogix <http://www.eulogix.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Eulogix\Cool\Lib\File;

use Eulogix\Lib\File\Proxy\FileProxyInterface;

interface TempManagerInterface
{
    /**
     * @param string $uploadedName
     * @param string $temporaryUploadedFile
     * @return string
     */
    public function storeFile($uploadedName, $temporaryUploadedFile);

    /**
     * @param string $id
     * @return string
     */
    public function getFileName($id);

    /**
     * @param string $id
     * @return string
     */
    public function getLocalFile($id);

    /**
     * generates a temporary, one-time key that is used to later retrieve the file with a simple URL
     * @param FileProxyInterface $fp
     * @return string
     */
    public function getTempKeyFromFileProxy(FileProxyInterface $fp);

    /**
     * generates a temporary key used to mask the path of a local file
     * @param string $file
     * @param string $fileName optional
     * @return string
     */
    public function getTempKeyFromLocalFile($file, $fileName = null);

    /**
     * @param $key
     * @return FileProxyInterface|null
     */
    public function getFileProxyFromTempKey($key);

    /**
     * @param FileProxyInterface $fp
     * @return string
     */
    public function getDownloadUrlFromFileProxy(FileProxyInterface $fp);

    /**
     * @param FileProxyInterface $fp
     * @return string
     */
    public function getServeUrlFromFileProxy(FileProxyInterface $fp);

    /**
     * @param string $key
     * @return string
     */
    public function getDownloadUrlFromTempKey($key);

    /**
     * @param string $key
     * @return string
     */
    public function getServeUrlFromTempKey($key);
}