<?php
include 'entete.php';

if (!empty($_GET['id'])) {
    $demande = getRecuDemande($_GET['id']);
}
?>

<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .mtable {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-top: 20px;
    }

    th, td {
        padding: 10px;
    }

    th {
        background-color: #f9f9f9;
        text-align: center;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A4;
        margin: 0;
    }

    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    .btn-print {
  position: fixed;
  bottom: 0;
  right: 0;
  padding: 10px 20px;
  background-color: #64c6f0;
  border: 1px solid #ccc;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  color: #fff;
}

.btn-print:hover {
  background-color: #21abdd;
  color: #fff;
}
</style>

<<div class="home-content">
    <button class="btn-print" id="btnPrint"><i class='bx bx-printer' > Imprimer</i></button>
    <div class="page">
        <div class="cote-a-cote">
            <h2>Demande</h2>
            <div>
                
            <?php if (!empty($demande)) : ?>
                    <p>Nom utilisateur : <?= $demande['nomu'] ?></p>
                    <p>N° telephone : <?= $demande['tel'] ?></p>
                    <p>Adresse E-mail : <?= $demande['mail'] ?></p>
                    <p>Service : <?= $demande['serviceu'] ?></p>
                    <p>Agence : <?= $demande['agenceu'] ?></p>
            <?php endif; ?> 
            </div>
        </div>
        <div class="box">
            <form>
            <table class="mtable">
                    <tr>
                        <th> Inventaire </th>
                        <th> Marque </th>
                        <th> Date d'achat </th>
                        <th> Reference </th>
                        <th> Observation </th>
                    </tr>
                    <?php if (!empty($demande)) : ?>
                        <tr>
                            <td><?= $demande['inventaireu'] ?></td>
                            <td><?= $demande['marqueu'] ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($demande['dateu'])) ?></td>
                            <td><?= $demande['referenceu'] ?></td>
                            <td><?= $demande['observationu'] ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </form>
        </div>
    </div>
    <script>
        var btnPrint = document.querySelector('#btnPrint');
        btnPrint.addEventListener("click",() => {
            window.print();
        });
    </script>
</div>


<?php include 'pied.php'; ?>
