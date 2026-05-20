<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<?php
    $this->need('toc.php');
    $originalContent = $this->content;
    $this->content = addIDsToHeadings($originalContent);
    $this->toc = generateToc($this->content);
?>

<div class="col-mb-12 col-8" id="main" role="main">
    <article class="post" itemscope itemtype="http://schema.org/BlogPosting">
        <?php postMeta($this, 'post'); ?>
        <div class="post-content <?php if ($this->options->prismjsLineNumbers) echo "line-numbers";?>" itemprop="articleBody">
            <?php $this->content(); ?>
        </div>

        <?php if ($this->fields->isCC == 1): ?>
            <div style="border-top: 1px solid #eee; margin: 2em 0;"></div>
            <blockquote>
                <strong>本文作者：</strong><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                <br><br>
                <strong>本文链接：</strong><a target="_blank" href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a>
                <br><br>
                <strong>版权声明：</strong>本文为原创内容，采用 <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank"> 知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议（CC BY-NC-SA 4.0）</a> 进行许可，转载时须注明出处及本声明。
            </blockquote>
        <?php elseif ($this->fields->isCC == 2): ?>
            <div style="border-top: 1px solid #eee; margin: 2em 0;"></div>
            <blockquote>
                <strong>本文作者：</strong><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a>
                <br><br>
                <strong>本文链接：</strong><a target="_blank" href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a>
                <br><br>
                <strong>版权声明：</strong>本文部分内容引用或转载自网络，已标明出处，若侵权请联系删除。本文原创部分采用 <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank"> 知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议（CC BY-NC-SA 4.0）</a> 进行许可，转载时须注明出处及本声明。
            </blockquote>
        <?php endif; ?>
    </article>

    <?php $this->need('comments.php'); ?>

</div><!-- end #main-->

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
