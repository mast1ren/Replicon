<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-mb-12 col-offset-1 col-3 kit-hidden-tb" id="secondary" role="complementary">
    <?php if ($this->is('post') && $this->toc && !empty($this->options->sidebarBlock) && in_array('ShowTOC', $this->options->sidebarBlock)): ?>
        <section class="widget" id="sidebar-toc">
            <h3 class="widget-title"><?php _e('文章目录'); ?></h3>
            <?php echo $this->toc; ?>
        </section>
    <!---?php else: ?--->
    <?php endif; ?>
        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentPosts', $this->options->sidebarBlock) && !$this->is('index')): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('最新文章'); ?></h3>
                <ul class="widget-list">
                    <?php $recentPostsCount = $this->options->recentPostsCount ?: 5; ?>
                    <?php \Widget\Contents\Post\Recent::alloc(['pageSize' => intval($recentPostsCount)])
                        ->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentUpdates', $this->options->sidebarBlock)): ?>
        <section class="widget">
            <h3 class="widget-title"><?php _e('最近更新'); ?></h3>
            <ul class="widget-list">
                <?php
                $db = Typecho_Db::get();
                $recentUpdatesCount = $this->options->recentUpdatesCount ?: 5;
                $rows = $db->fetchAll($db->select('cid', 'title')
                    ->from('table.contents')
                    ->where('type = ?', 'post')
                    ->where('status = ?', 'publish')
                    ->order('modified', Typecho_Db::SORT_DESC)
                    ->limit(intval($recentUpdatesCount)));
                foreach ($rows as $row):
                    $permalink = Typecho_Common::url('/archives/' . $row['cid'] . '/', $this->options->index);
                ?>
                    <li><a href="<?php echo $permalink; ?>"><?php echo htmlspecialchars($row['title']); ?></a></li>
                <?php endforeach; ?>
            </ul>
        </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowRecentComments', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('最近回复'); ?></h3>
                <ul class="widget-list">
                    <?php $recentCommentsCount = $this->options->recentCommentsCount ?: 5; ?>
                    <?php \Widget\Comments\Recent::alloc(['pageSize' => intval($recentCommentsCount)])->to($comments); ?>
                    <?php while ($comments->next()): ?>
                        <li>
                            <a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowCategory', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('分类'); ?></h3>
                <?php \Widget\Metas\Category\Rows::alloc()->listCategories('wrapClass=widget-list'); ?>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowArchive', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('归档'); ?></h3>
                <ul class="widget-list">
                    <?php \Widget\Contents\Post\Date::alloc('type=month&format=F Y')
                        ->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
                </ul>
            </section>
        <?php endif; ?>

        <?php if (!empty($this->options->sidebarBlock) && in_array('ShowOther', $this->options->sidebarBlock)): ?>
            <section class="widget">
                <h3 class="widget-title"><?php _e('杂项'); ?></h3>
                <ul class="widget-list">
                    <?php if ($this->user->hasLogin()): ?>
                        <li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?>
                                (<?php $this->user->screenName(); ?>)</a></li>
                        <li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
                    <?php else: ?>
                        <li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a>
                        </li>
                    <?php endif; ?>
                    <li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
                    <li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
                </ul>
            </section>
        
    <?php endif; ?>
</div><!-- end #sidebar -->
