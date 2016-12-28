<div style="width: 100%; height: 80px;">
    <span style="float: left;"><h2><?= h($shop['Shop']['name']); ?></h2></span>
    <span style="float: right;"><h3><?= h($shop['Shop']['tel']); ?></h3></span>
</div>

<div>
    <span>店舗情報</span>
    <table>
        <tbody>
            <tr>
                <td rowspan="5" style="width: 30%;">
                    <?= $this->Shop->photoImage($shop, ['style' => 'width: 100%']); ?>
                </td>
                <td style="width: 20%;">店名</td>
                <td><?= h($shop['Shop']['name']); ?></td>
            </tr>
            <tr>
                <td>TEL・予約</td>
                <td><?= h($shop['Shop']['tel']); ?></td>
            </tr>
            <tr>
                <td>住所</td>
                <td><?= h($shop['Shop']['addr']); ?></td>
            </tr>
            <tr>
                <td>ホームページ</td>
                <td><?= h($shop['Shop']['url']); ?></td>
            </tr>
            <tr>
                <td>評価</td>
                <td>
                    <?php if (count($shop['Review']) > 0) : ?>
                        <?= $this->Shop->scoreList()[round($averageScore)]; ?>&nbsp;
                        ( <?= $averageScore; ?> )
                    <?php else: ?>
                        <p>まだ、レビューがありません。</p>
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
    <?php if ($currentUser) : ?>
        <div style="text-align:right;">
            <?= $this->Html->link(
                '編集',
                ['action' => 'edit', $shop['Shop']['id']]
            ); ?>
        </div>
    <?php endif; ?>
</div>

<?php if (count($shop['Review']) > 0) : ?>
    <div style="margin-top: 30px;">
        <span>レビュー一覧</span>
        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">評価</th>
                    <th style="width: 20%;">タイトル</th>
                    <th>内容</th>
                    <th style="width: 20%;">会員</th>
                    <th style="width: 10%;">訪問日</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($shop['Review'] as $review): ?>
                <tr>
                    <td><?= $this->Shop->scoreList()[$review['score']]; ?></td>
                    <td><?= h($review['title']); ?></td>
                    <td><?= h($review['body']); ?></td>
                    <td><?= h($review['User']['email']); ?></td>
                    <td><?= $this->Time->format($review['created'], '%Y/%m/%d'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div style="margin-top: 30px;">
        <p>まだ、レビューがありません。</p>
    </div>
<?php endif; ?>

<?php if ($currentUser) : ?>
    <div style="margin-top: 20px;">
        <div style="text-align: right;">
            <?= $this->Html->link(
                'レビューを' . $reviewLabel . 'する',
                [
                    'controller' => 'reviews',
                    'action' => 'edit',
                    'shop_id' => $shop['Shop']['id'],
                ]
            ); ?>
        </div>
    </div>
<?php endif; ?>