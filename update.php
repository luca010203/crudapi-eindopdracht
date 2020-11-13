<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $naam = isset($_POST['naam']) ? $_POST['naam'] : '';
        $beschrijving = isset($_POST['beschrijving']) ? $_POST['beschrijving'] : '';
        $prijs = isset($_POST['prijs']) ? $_POST['prijs'] : '';
        $categorie_id = isset($_POST['categorie_id']) ? $_POST['categorie_id'] : '';
        $toegevoegd_op = isset($_POST['toegevoegd_op']) ? $_POST['toegevoegd_op'] : date('Y-m-d H:i:s');
        $gewijzigd_op = isset($_POST['gewijzigd_op']) ? $_POST['gewijzigd_op'] : date('Y-m-d H:i:s');
        $stmt = $pdo->prepare('UPDATE product SET id = ?, naam = ?, beschrijving = ?, prijs = ?, categorie_id = ?, toegevoegd_op = ?, gewijzigd_op = ? WHERE id = ?');
        $stmt->execute([$id, $naam, $beschrijving, $prijs, $categorie_id, $toegevoegd_op, $gewijzigd_op, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    $stmt = $pdo->prepare('SELECT * FROM product WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
    <label for="id">ID</label>
        <label for="naam">naam</label>

        <input type="text" name="id" placeholder="26" value="<?=$contact['id']?>" id="id">
        <input type="text" name="naam" placeholder="vul uw naam in" value="<?=$contact['naam']?>" id="naam">

        <label for="beschrijving">beschrijving</label>
        <label for="prijs">prijs</label>

        <input type="text" name="beschrijving" placeholder="e@mail.com" value="<?=$contact['beschrijving']?>" id="beschrijving">
        <input type="number" name="prijs" placeholder="203" value="<?=$contact['prijs']?>" id="prijs">

        <label for="categorie_id">categorie_id</label>
        <label for="toegevoegd_op">toegevoegd_op</label>

        <input type="text" name="categorie_id" placeholder="categorie_id" value="<?=$contact['categorie_id']?>" id="categorie_id">
        <input type="datetime-local" name="toegevoegd_op" value="<?=date('Y-m-d\TH:i')?>" id="toegevoegd_op">
        
        <label for="gewijzigd_op">gewijzigd_op</label>
        
        <input type="datetime-local" name="gewijzigd_op" value="<?=date('Y-m-d\TH:i')?>" id="gewijzigd_op">        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
