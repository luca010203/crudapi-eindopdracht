<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
if (isset($_GET['search'])) {
	$stmt = $pdo->prepare('SELECT * FROM product
						   WHERE id LIKE :search_query
							  OR naam LIKE :search_query
							  OR beschrijving LIKE :search_query
							  OR prijs LIKE :search_query
							  OR categorie_id LIKE :search_query
							  OR toegevoegd_op LIKE :search_query
							  OR gewijzigd_op LIKE :search_query
							ORDER BY id
							LIMIT :current_page, :record_per_page');
	$stmt->bindValue(':search_query', '%' . $_GET['search'] . '%');
} else {
	$stmt = $pdo->prepare('SELECT * FROM product ORDER BY id LIMIT :current_page, :record_per_page');
}
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['search'])) {
	$stmt = $pdo->prepare('SELECT COUNT(*) FROM product
						   WHERE id LIKE :search_query
							  OR naam LIKE :search_query
							  OR beschrijving LIKE :search_query
							  OR prijs LIKE :search_query
							  OR categorie_id LIKE :search_query
							  OR toegevoegd_op LIKE :search_query
							  OR gewijzigd_op LIKE :search_query');
	$stmt->bindValue(':search_query', '%' . $_GET['search'] . '%');
	$stmt->execute();
	$num_contacts = $stmt->fetchColumn();
} else {
	$num_contacts = $pdo->query('SELECT COUNT(*) FROM product')->fetchColumn();
}
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Producten overzicht</h2>
	<div class="top">
		<a href="create.php">Maak contact aan</a>
		<a href="register.php">sign in</a>
		<form action="index.php" method="get">
		</form>
	</div>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>naam</td>
                <td>beschrijving</td>
                <td>prijs</td>
                <td>categorie_id</td>
                <td>toegevoegd_op</td>
                <td>gewijzigd_op</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['naam']?></td>
                <td><?=$contact['beschrijving']?></td>
                <td><?=$contact['prijs']?></td>
                <td><?=$contact['categorie_id']?></td>
                <td><?=$contact['toegevoegd_op']?></td>
                <td><?=$contact['gewijzigd_op']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="index.php?page=<?=$page-1?><?=isset($_GET['search']) ? '&search=' . htmlentities($_GET['search'], ENT_QUOTES) : ''?>">
			<i class="fas fa-angle-double-left fa-sm"></i>
		</a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="index.php?page=<?=$page+1?><?=isset($_GET['search']) ? '&search=' . htmlentities($_GET['search'], ENT_QUOTES) : ''?>">
			<i class="fas fa-angle-double-right fa-sm"></i>
		</a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>
