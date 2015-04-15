<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Profissional'), ['action' => 'edit', $profissional->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Profissional'), ['action' => 'delete', $profissional->id], ['confirm' => __('Are you sure you want to delete # {0}?', $profissional->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Profissional'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Profissional'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="profissional view large-10 medium-9 columns">
    <h2><?= h($profissional->id) ?></h2>
    <div class="row">
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($profissional->id) ?></p>
            <h6 class="subheader"><?= __('Utilizador') ?></h6>
            <p><?= $this->Number->format($profissional->utilizador) ?></p>
        </div>
    </div>
</div>
