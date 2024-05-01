<?php
include 'perpustakaan.php';
include 'referensi-buku.php';

$perpus = new Perpustakaan();

$bukuDummy = [
    [1, "Introduction to Algorithms", "Thomas H. Cormen", 2009, "Available", "978-0-262-03384-8", "MIT Press"],
    [2, "The Art of Computer Programming", "Donald E. Knuth", 1968, "Borrowed", "978-0-201-03801-1", "Addison-Wesley"],
    [3, "Clean Code: A Handbook of Agile Software Craftsmanship", "Robert C. Martin", 2008, "Available", "978-0-13-235088-4", "Prentice Hall"],
    [4, "Design Patterns: Elements of Reusable Object-Oriented Software", "Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides", 1994, "Available", "978-0-201-63361-0", "Addison-Wesley"],
    [5, "Cracking the Coding Interview", "Gayle Laakmann McDowell", 2008, "Borrowed", "978-0-9843025-3-1", "CareerCup"],
    [6, "Code Complete: A Practical Handbook of Software Construction", "Steve McConnell", 1993, "Available", "978-1-55615-484-3", "Microsoft Press"],
    [7, "Structure and Interpretation of Computer Programs", "Harold Abelson, Gerald Jay Sussman, Julie Sussman", 1984, "Available", "978-0-262-51087-5", "MIT Press"],
    [8, "Head First Design Patterns", "Eric Freeman, Elisabeth Robson, Bert Bates, Kathy Sierra", 2004, "Borrowed", "978-0-596-00712-6", "O'Reilly Media"],
    [9, "Patterns of Enterprise Application Architecture", "Martin Fowler", 2002, "Available", "978-0-321-12742-6", "Addison-Wesley"],
    [10, "Refactoring: Improving the Design of Existing Code", "Martin Fowler", 1999, "Borrowed", "978-0-201-48567-7", "Addison-Wesley"],
    [11, "The Mythical Man-Month: Essays on Software Engineering", "Frederick P. Brooks Jr.", 1975, "Available", "978-0-201-00650-6", "Addison-Wesley"],
    [12, "Gödel, Escher, Bach: An Eternal Golden Braid", "Douglas Hofstadter", 1979, "Available", "978-0-465-02656-2", "Basic Books"],
    [13, "Artificial Intelligence: A Modern Approach", "Stuart Russell, Peter Norvig", 1995, "Available", "978-0-13-103805-9", "Prentice Hall"],
    [14, "Operating System Concepts", "Abraham Silberschatz, Peter Baer Galvin, Greg Gagne", 1989, "Borrowed", "978-0-471-59270-3", "Wiley"],
    [15, "Computer Networks", "Andrew S. Tanenbaum", 1981, "Available", "978-0-13-349945-0", "Prentice Hall"],
];

foreach ($bukuDummy as $buku) {
    $myBuku = new BukuReferensi($buku[0], $buku[1], $buku[2], $buku[3], $buku[4], $buku[5], $buku[6]);
    $perpus->tambahBuku($myBuku);
}

$katakunci = isset($_GET['katakunci']) ? $_GET['katakunci'] : '';

if (!empty($katakunci)) {
    $hasilPencarian = $perpus->cariBuku($katakunci);
} else {
    $hasilPencarian = $perpus->koleksiBuku;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['borrow'])) {
        $id = $_POST['book_id'];
        $message = $perpus->pinjamBuku($id_pengguna, $id_buku, $tanggal_pinjam, $lama_pinjam);
        echo "<script>alert('$message');</script>";
    } elseif (isset($_POST['return'])) {
        $id = $_POST['book_id'];
        $lateFee = $perpustakaan->kembalikanBuku($id_pengguna, $id_buku, $tanggal_pengembalian); // Anda dapat mengganti ID pengguna dengan ID yang sesuai
        if (is_numeric($lateFee)) {
            echo "<script>alert('Buku berhasil dikembalikan. Denda keterlambatan: $' + $lateFee);</script>";
        } else {
            echo "<script>alert('$lateFee');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Web 2 | Library App</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start(); // Mulai sesi untuk menyimpan status login

    // Logika Login User
    $loggedIn = isset($_SESSION['username']); // Periksa apakah pengguna sudah login
    $username = $_SESSION['username'] ?? ""; // Ambil username pengguna yang login jika ada

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["login"])) {
            // Proses login, misalnya dengan username dan password yang sudah ditetapkan
            $username = $_POST["username"];
            // Jika benar, set session untuk menandai bahwa pengguna sudah login
            $_SESSION['username'] = $username;
            $loggedIn = true;
        } elseif (isset($_POST["logout"])) {
            // Proses logout, hapus session untuk menandai bahwa pengguna sudah logout
            unset($_SESSION['username']);
            $loggedIn = false;
            // Redirect ke halaman login setelah logout
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }

    if ($loggedIn) { ?>
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/013/083/736/small_2x/stick-man-with-book-shelves-in-library-education-and-learning-concept-3d-illustration-or-3d-rendering-png.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="500" height="200" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <?= "<h1 class='display-5 fw-bold lh-1 mb-3'>Selamat datang $username</h1>" ?>
                    <p class="lead">Ilmu itu ada di mana-mana, pengetahuan di mana-mana tersebar, kalau kita bersedia membaca, dan bersedia mendengar.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <form action="" method="GET" class="row justify-content-center py-2">
                            <div class="col-auto">
                                <label for="search" class="visually-hidden">Cari Judul atau penulis</label>
                                <input name="katakunci" type="text" class="form-control" id="Search" placeholder="Cari judul atau penulis">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($hasilPencarian as $buku) { ?>
                        <tr>
                            <th scope="row"><?= $buku->id_buku ?></th>
                            <td><?= $buku->judul ?></td>
                            <td><?= $buku->penulis ?></td>
                            <td><?= $buku->tahun_terbit ?></td>
                            <td><?= $buku->isbn ?></td>
                            <td><?= $buku->penerbit ?></td>
                            <td><?= $buku->status ?></td>
                            <td>
                                <?php if ($buku->status == "Available") : ?>
                                    <form action="" method="POST">
                                        <input type="hidden" name="book_id" value="<?= $buku->id_buku ?>">
                                        <button type="submit" name="borrow" class="btn btn-primary">Pinjam</button>
                                    </form>
                                <?php else : ?>
                                    <form action="" method="POST">
                                        <input type="hidden" name="book_id" value="<?= $buku->id_buku ?>">
                                        <button type="submit" name="return" class="btn btn-warning">Kembalikan</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        // Tombol Logout

    <?php } else { ?>
        <div class="container-fluid text-center">
            <div class="row login-form w-100 flex bg-dark justify-conten-center align-items-center text-white">
                <div class="col-4 py-5 text-center mx-auto">
                    <h1>Selamat datang di perpustakaanku</h1>
                    <p>Silahkan login terlebih dahulu</p>
                    <form method='post' class="py-4 text-center d-flex justify-content-center no-wrap">
                        <input type='text' name='username' placeholder="Masukkan nama kamu" class="form-control" required><br>
                        <input type='submit' name='login' value='Login' class="btn btn-primary mx-2">
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>