<?php
/**
 * EpagesSquiz_Sniffs_Files_FileExtensionSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@EpagesSquiz.net>
 * @author    Marc McIntyre <mmcintyre@EpagesSquiz.net>
 * @copyright 2006-2014 EpagesSquiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/EpagesSquizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * EpagesSquiz_Sniffs_Files_FileExtensionSniff.
 *
 * Tests that classes and interfaces are not declared in .php files
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@EpagesSquiz.net>
 * @author    Marc McIntyre <mmcintyre@EpagesSquiz.net>
 * @copyright 2006-2014 EpagesSquiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/EpagesSquizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: 2.1.0
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class EpagesSquiz_Sniffs_Files_FileExtensionSniff implements PHP_CodeSniffer_Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_OPEN_TAG);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in the
     *                                        stack passed in $tokens.
     *
     * @return int
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens    = $phpcsFile->getTokens();
        $fileName  = $phpcsFile->getFileName();
        $extension = substr($fileName, strrpos($fileName, '.'));
        $nextClass = $phpcsFile->findNext(array(T_CLASS, T_INTERFACE, T_TRAIT), $stackPtr);

        if ($nextClass !== false) {
            $phpcsFile->recordMetric($stackPtr, 'File extension for class files', $extension);
            if ($extension === '.php') {
                $error = '%s found in ".php" file; use ".inc" extension instead';
                $data  = array(ucfirst($tokens[$nextClass]['content']));
                $phpcsFile->addError($error, $stackPtr, 'ClassFound', $data);
            }
        } else {
            $phpcsFile->recordMetric($stackPtr, 'File extension for non-class files', $extension);
            if ($extension === '.inc') {
                $error = 'No interface or class found in ".inc" file; use ".php" extension instead';
                $phpcsFile->addError($error, $stackPtr, 'NoClass');
            }
        }

        // Ignore the rest of the file.
        return ($phpcsFile->numTokens + 1);

    }//end process()


}//end class
