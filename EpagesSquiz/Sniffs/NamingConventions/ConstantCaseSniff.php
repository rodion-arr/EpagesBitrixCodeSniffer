<?php
/**
 * EpagesSquiz_Sniffs_NamingConventions_ValidFunctionNameSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@EpagesSquiz.net>
 * @copyright 2006-2014 EpagesSquiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/EpagesSquizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

if (class_exists('EpagesGeneric_Sniffs_PHP_LowerCaseConstantSniff', true) === false) {
    $error = 'Class EpagesGeneric_Sniffs_PHP_LowerCaseConstantSniff not found';
    throw new PHP_CodeSniffer_Exception($error);
}

if (class_exists('EpagesGeneric_Sniffs_PHP_UpperCaseConstantSniff', true) === false) {
    $error = 'Class EpagesGeneric_Sniffs_PHP_UpperCaseConstantSniff not found';
    throw new PHP_CodeSniffer_Exception($error);
}

/**
 * EpagesSquiz_Sniffs_NamingConventions_ConstantCaseSniff.
 *
 * Ensures TRUE, FALSE and NULL are uppercase for PHP and lowercase for JS.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Greg Sherwood <gsherwood@EpagesSquiz.net>
 * @copyright 2006-2014 EpagesSquiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/EpagesSquizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 * @version   Release: 2.1.0
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class EpagesSquiz_Sniffs_NamingConventions_ConstantCaseSniff extends EpagesGeneric_Sniffs_PHP_LowerCaseConstantSniff
{


    /**
     * Processes this sniff, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        if ($phpcsFile->tokenizerType === 'JS') {
            parent::process($phpcsFile, $stackPtr);
        } else {
            $sniff = new EpagesGeneric_Sniffs_PHP_UpperCaseConstantSniff;
            $sniff->process($phpcsFile, $stackPtr);
        }

    }//end process()


}//end class
