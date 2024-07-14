# Color Contrast

WCAG2.2 に定義されている 文字コントラスト算出CLI

- https://waic.jp/translations/WCAG22/#dfn-contrast-ratio
- https://waic.jp/translations/WCAG22/#dfn-relative-luminance


## How to use

```bash
make run
```

### Example
```bash
color-contrast % make run
docker compose run --rm php php index.php contrast:check

 Input the color code. (ex: #ffffff):
 > #FFF

 Input the color code you want to compare. (ex: #ffffff):
 > #000

  [OK] 1 : 21              
 ```
