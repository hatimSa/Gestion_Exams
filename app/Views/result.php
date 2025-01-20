<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background-color: #6e7cb2;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }

        .card {
            width: 250px;
    height: 250px;
    background-image: url('https://imgs.search.brave.com/-BZwV_ErM11N6dKWE_j6yczzhbnHPNAjbMhbSSFUCOA/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy9j/L2MyL0NNQVBfLV9D/ZW50cmVfZGVfTWF0/aCVDMyVBOW1hdGlx/dWVzX0FwcGxpcXUl/QzMlQTllc19kZV9s/J0Vjb2xlX3BvbHl0/ZWNobmlxdWUuanBn'); /* Remplacer le chemin par celui de ton image */
    background-size: cover; /* Pour que l'image couvre toute la surface de la carte */
    background-position: center; /* Centrer l'image */
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 18px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    position: relative;
        }

        .card:hover {
            transform: scale(1.05);  /* Légère augmentation de la taille */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombre plus forte */
            background-color: #3e8e41;  /* Changer la couleur de fond au survol */
        }

        .card:active {
            transform: scale(1.02);  /* Légère réduction lorsqu'on clique */
        }

        .card span {
            font-size: 28px;
            font-weight: bold;
        }

        /* Effet de "pointer" au passage de la souris */
        .card span:after {
            content: " →";
            font-size: 22px;
            position: absolute;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover span:after {
            opacity: 1;
        }
        
    </style>
</head>

<body>

    <!-- Sidebar -->
    <?php include('profSidebar.php'); ?>

    <div class="main-content">
        <div class="header">
            <h1>Exams</h1>
        </div>
        <div class="card-container">
            <!-- Exemple de carte dynamique pour un examen -->
            <a href="/exam/1" class="card">
                <span>Exam 1</span>
            </a>

            <!-- Carte pour un autre examen -->
            <a href="/exam/2" class="card">
                <span>Exam 2</span>
            </a>

            <!-- Ajoute d'autres cartes selon les examens -->
            <a href="/exam/3" class="card">
                <span>Exam 3</span>
            </a>

            <a href="/exam/4" class="card">
                <span>Exam 4</span>
            </a>
        </div>
    </div>

</body>

</html>
