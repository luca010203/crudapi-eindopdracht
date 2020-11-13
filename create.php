<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $naam = isset($_POST['naam']) ? $_POST['naam'] : '';
    $beschrijving = isset($_POST['beschrijving']) ? $_POST['beschrijving'] : '';
    $prijs = isset($_POST['prijs']) ? $_POST['prijs'] : '';
    $categorie_id = isset($_POST['categorie_id']) ? $_POST['categorie_id'] : '';
    $toegevoegd_op = isset($_POST['toegevoegd_op']) ? $_POST['toegevoegd_op'] : date('Y-m-d H:i:s');
    $gewijzigd_op = isset($_POST['gewijzigd_op']) ? $_POST['gewijzigd_op'] : date('Y-m-d H:i:s');
    $stmt = $pdo->prepare('INSERT INTO product VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $naam, $beschrijving, $prijs, $categorie_id, $toegevoegd_op, $gewijzigd_op]);
    $msg = 'Created Successfully!';
}
?>

<?=template_header('Create')?>

<div class="content update">
	<h2>Creeër een contact</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="naam">naam</label>

        <input type="text" name="id" placeholder="26" value="auto" id="id">
        <input type="text" name="naam" placeholder="vul uw naam in" id="naam">

        <label for="beschrijving">beschrijving</label>
        <label for="prijs">prijs</label>

        <input type="text" name="beschrijving" placeholder="e@mail.com" id="beschrijving">
        <input type="number" name="prijs" placeholder="203" id="prijs">

        <label for="categorie_id">categorie_id</label>
        <label for="toegevoegd_op">toegevoegd_op</label>

        <input type="text" name="categorie_id" placeholder="categorie_id" id="categorie_id">
        <input type="datetime-local" name="toegevoegd_op" value="<?=date('Y-m-d\TH:i')?>" id="toegevoegd_op">

        <label for="gewijzigd_op">gewijzigd_op</label>

        <input type="datetime-local" name="gewijzigd_op" value="<?=date('Y-m-d\TH:i')?>" id="gewijzigd_op">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
