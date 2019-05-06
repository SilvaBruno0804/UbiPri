function filterCharacters(texto)
{
 texto = texto.replace(/^\s+|\s+$/g, "");//tira espaços do inicio e do fim
 texto = texto.replace(/\s{2,}/g, " ");//tira espaços duplicados
 
 replacements = {
  "&Aacute;": "Á",
  "&aacute;": "á",
  "&Acirc;": "Â",
  "&acirc;": "â",
  "&Agrave;": "À",
  "&agrave;": "à",
  "&Aring;": "Å",
  "&aring;": "å",
  "&Atilde;": "Ã",
  "&atilde;": "ã",
  "&Auml;": "Ä",
  "&auml;": "ä",
  "&AElig;": "Æ",
  "&aelig;": "æ",
  "&Eacute;": "É",
  "&eacute;": "é",
  "&Ecirc;": "Ê",
  "&ecirc;": "ê",
  "&Egrave;": "È",
  "&egrave;": "è",
  "&Ecirc;": "Ê",
  "&ecirc;": "ê",
  "&Egrave;": "È",
  "&egrave;": "è",
  "&Euml;": "Ë",
  "&euml;": "ë",
  "&ETH;": "Ð",
  "&eth;": "ð",
  "&Iacute;": "Í",
  "&iacute;": "í",
  "&Icirc;": "Î",
  "&icirc;": "î",
  "&Igrave;": "Ì",
  "&igrave;": "ì",
  "&Iuml;": "Ï",
  "&iuml;": "ï",
  "&Oacute;": "Ó",
  "&oacute;": "ó",
  "&Ocirc;": "Ô",
  "&ocirc;": "ô",
  "&Ograve;": "Ò",
  "&ograve;": "ò",
  "&Oslash;": "Ø",
  "&oslash;": "ø",
  "&Otilde;": "Õ",
  "&otilde;": "õ",
  "&Ouml;": "Ö",
  "&ouml;": "ö",
  "&Uacute;": "Ú",
  "&uacute;": "ú",
  "&Ucirc;": "Û",
  "&ucirc;": "û",
  "&Ugrave;": "Ù",
  "&ugrave;": "ù",
  "&Uuml;": "Ü",
  "&uuml;": "ü",
  "&Ccedil": "Ç",
  "&ccedil;": "ç",
  "&Ntilde;": "Ñ",
  "&ntilde;": "ñ",
  "&lt;": "<",
  "&gt;": ">",
  "&amp;": "&",
  "&quot;": "'",
  "&reg;": "®",
  "&copy;": "©",
  "&Yacute": "Ý",
  "&yacute": "ý",
  "&THORN;": "Þ",
  "&thorn;": "þ",
  "&szlig;": "ß"
  
 };
 
 
 regex = {};
 for (key in replacements) {
   regex[key] = new RegExp(key, 'g');
 }

 for(key in replacements){
   texto = texto.replace(regex[key], replacements[key]);//tira caracteres acentuados
 }
 
    return texto;
}