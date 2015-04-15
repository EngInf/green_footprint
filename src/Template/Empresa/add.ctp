<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Empresa'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="empresa form large-10 medium-9 columns">
    <?= $this->Form->create($empresa); ?>
    <fieldset>
        <legend><?= __('Add Empresa') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('localidade');
            echo $this->Form->input('cae');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
