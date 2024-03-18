<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],

    ];

    // variabili
    $parkFilter = isset($_GET['parking']);
    $minVote = isset($_GET['minVote']) ? $_GET['minVote'] : 0;

    // Se la checkbox è selezionata, filtriamo gli hotel che hanno il parcheggio
    if ($parkFilter) {
        $hotels = array_filter($hotels, function ($hotel) {
            return $hotel['parking'] == true;
        });
    };

    // controllo if per filtrare in base al voto
    if ($minVote > 0) {
        $hotels = array_filter($hotels, function ($hotel) use ($minVote) {
            return $hotel['vote'] >= $minVote;
        });
    }

?>


<!DOCTYPE html>
<html lang="it" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP HOTEL</title>
    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    
    <div class="container my-5">

        <h1 class="text-center mb-5">HOTEL</h1>

        <div class="container">

            <!-- Form per filtrare gli hotel con parcheggio -->
            <form method="GET">
                <div class="form-check p-2 d-flex justify-content-end align-items-center gap-3 mb-3">
                    <input class="form-check-input" type="checkbox" value="1" id="parking" name="parking" <?php if ($parkFilter) echo 'checked'; ?>>
                    <label class="form-check-label" for="parking">
                        Mostra solo hotel con parcheggio
                    </label>
                </div>
                <div class="form-group p-2 d-flex justify-content-end align-items-center gap-3 mb-3">
                    <label for="minVote">Voto minimo:</label>
                    <input type="number" id="minVote" name="minVote" value="<?php echo $minVote; ?>">
                    <button type="submit" class="btn btn-outline-primary fw-bold">Filtra</button>
                </div>
            </form>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Parcheggio</th>
                        <th scope="col">Voto</th>
                        <th scope="col">Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($hotels as $hotel) { ?>
                        <tr>
                            <td>
                                <?php echo $hotel['name']; ?>
                            </td>
                            <td>
                                <?php echo $hotel['description']; ?>
                            </td>
                            <td>
                                <?php echo $hotel['parking'] ? 'Sì' : 'No'; ?>
                            </td>
                            <td>
                                <?php echo $hotel['vote']; ?>
                            </td>
                            <td>
                                <?php echo $hotel['distance_to_center']; ?> km
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

    </div>


    <!-- link bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>