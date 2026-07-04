# News PHP Project

## Character Encoding

**All code files in this project use GBK encoding.** Do NOT convert to UTF-8 or any other encoding. This applies to:

- PHP files (`.php`)
- CSS files (`.css`)
- HTML templates
- JavaScript files
- SQL scripts

## Database

- Database charset: `gbk`
- MySQL connection charset: `gbk`
- Uses `mysql_*` functions (legacy PHP MySQL extension)

## Notes

- File paths in `uploads/` may contain Chinese filenames
- FCKeditor library is bundled at `fckeditor/`
