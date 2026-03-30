<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="page-header-left">
        <h1><i class="fas fa-briefcase me-2" style="color:var(--adm-primary);"></i> Homepage Selection Cards</h1>
        <p>Manage the cards shown in the homepage job selections slider</p>
    </div>
    <a href="<?= base_url('admin/homepage-selection-cards/add') ?>" class="btn-vda btn-vda-primary">
        <i class="fas fa-plus"></i> Add Card
    </a>
</div>

<div class="vda-card">
    <div class="vda-card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Count</th>
                        <th>Label</th>
                        <th>Location</th>
                        <th>Badge</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cards as $card): ?>
                        <tr>
                            <td><?= esc($card['title']) ?></td>
                            <td><?= esc($card['count_value']) ?></td>
                            <td><?= esc($card['label']) ?></td>
                            <td><?= esc($card['location']) ?></td>
                            <td><?= esc($card['badge'] ?? '') ?></td>
                            <td><?= esc((string) ($card['sort_order'] ?? 0)) ?></td>
                            <td><?= !empty($card['status']) ? 'Active' : 'Inactive' ?></td>
                            <td>
                                <a href="<?= base_url('admin/homepage-selection-cards/edit/' . $card['id']) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                <a href="<?= base_url('admin/homepage-selection-cards/delete/' . $card['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this card?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
