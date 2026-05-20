<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

        </div><!-- end .row -->
    </div>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    <?php if ($this->options->copyrightInfo): ?>
        <span id="copyright">&copy; 2019-<?php echo date('Y'); ?>
        <a href="<?php $this->options->siteUrl(); ?>"><?php echo $this->options->copyrightInfo; ?></a>.</span>
    <?php endif ?>
    <span id="power">Powered by <a href="https://typecho.org">Typecho</a> & <a href="https://github.com/inuEbisu/Replicon">Replicon</a>.</span>
    <br>
    <?php if ($this->options->beianInfo): ?>
        <span id="beian"><a href="https://beian.miit.gov.cn/"><?php echo $this->options->beianInfo; ?></a></span>
    <?php endif ?>
</footer><!-- end #footer -->

<?php $this->footer(); ?>

<!-- FancyBox -->
<script data-cfasync="false" src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script data-cfasync="false">
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.post-content img').forEach(function(img) {
        // 跳过已经被包裹的图片
        if (img.closest('a')) return;
        var link = document.createElement('a');
        link.href = img.src;
        link.setAttribute('data-fancybox', 'gallery');
        link.setAttribute('data-caption', img.alt || '');
        img.parentNode.insertBefore(link, img);
        link.appendChild(img);
    });
    Fancybox.bind('[data-fancybox="gallery"]', {
        contentClick: 'iterateZoom',
        Toolbar: {
            display: {
                left: ['infobar'],
                middle: ['zoomIn', 'zoomOut', 'toggle1to1', 'rotateCCW', 'rotateCW', 'flipX', 'flipY'],
                right: ['slideshow', 'thumbs', 'close']
            }
        },
        Images: {
            Panzoom: {
                maxScale: 3
            }
        }
    });
});
</script>

<?php if ($this->is('post') && $this->fields->isLatex == 1): ?>
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    renderMathInElement(document.body, {
      delimiters: [{
          left: "$$",
          right: "$$",
          display: true
      }, {
          left: "$",
          right: "$",
          display: false
      }],
      ignoredTags: ["script", "noscript", "style", "textarea", "pre", "code"],
      ignoredClasses: ["nokatex"]
    });
  });
</script>
<?php endif; ?>

<?php if ($this->is('post') && $this->fields->isMermaid == 1): ?>
<script data-cfasync="false" src="https://cdn.jsdelivr.net/npm/mermaid@11/dist/mermaid.min.js"></script>
<script data-cfasync="false">
document.addEventListener("DOMContentLoaded", function() {
    mermaid.initialize({ startOnLoad: false, theme: 'default', securityLevel: 'loose', fontFamily: '"JetBrains Mono NL", "LXGW Wenkai Screen"' });
    var codeBlocks = document.querySelectorAll('code.lang-mermaid');
    codeBlocks.forEach(function(block, index) {
        var pre = block.parentNode;
        var div = document.createElement('div');
        div.className = 'mermaid';
        div.id = 'mermaid-' + index;
        div.textContent = block.textContent;
        pre.parentNode.replaceChild(div, pre);
    });
    if (codeBlocks.length > 0) {
        mermaid.run({ querySelector: '.mermaid' });
    }
});
</script>
<?php endif; ?>
