<?php

define('SALT_LENGTH', 9);
class SecurityHelper
{
    public static function GenerateHash($plainText, $salt = null)
    {
        if ($salt === null) {
            $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
        }
        else
        {
            $salt = substr($salt, 0, SALT_LENGTH);
        }

        return $salt . sha1($salt . $plainText);
    }

    function is_valid_email($email)
    {
        $result = TRUE;
        //eregi
        if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
            $result = FALSE;
        }
        return $result;
    }

// Function works on Both HTML, and XHTML
    public static function ContainsHtml($str, $count = FALSE)
    {
        $html = array('A', 'ABBR', 'ACRONYM', 'ADDRESS', 'APPLET', 'AREA', 'B', 'BASE', 'BASEFONT', 'BDO', 'BIG', 'BLOCKQUOTE', 'BODY', 'BR', 'BUTTON', 'CAPTION',
                      'CENTER', 'CITE', 'CODE', 'COL', 'COLGROUP', 'DD', 'DEL', 'DFN', 'DIR', 'DIV', 'DL', 'DT', 'EM', 'FIELDSET', 'FONT', 'FORM', 'FRAME', 'FRAMESET',
                      'H1', 'H2', 'H3', 'H4', 'H5', 'H6', 'HEAD', 'HR', 'HTML', 'I', 'IFRAME', 'IMG', 'INPUT', 'INS', 'ISINDEX', 'KBD', 'LABEL', 'LEGEND', 'LI', 'LINK',
                      'MAP', 'MENU', 'META', 'NOFRAMES', 'NOSCRIPT', 'OBJECT', 'OL', 'OPTGROUP', 'OPTION', 'P', 'PARAM', 'PRE', 'Q', 'S', 'SAMP', 'SCRIPT', 'SELECT', 'SMALL',
                      'SPAN', 'STRIKE', 'STRONG', 'STYLE', 'SUB', 'SUP', 'TABLE', 'TBODY', 'TD', 'TEXTAREA', 'TFOOT', 'TH', 'THEAD', 'TITLE', 'TR', 'TT', 'U', 'UL', 'VAR');
        if (preg_match_all("~(<\/?)\b(" . implode('|', $html) . ")\b([^>]*>)~i", $str, $c)) {
            if ($count)
                return array(TRUE, count($c[0]));
            else
                return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>