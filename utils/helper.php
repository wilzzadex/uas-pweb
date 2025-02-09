<?php 

// check session login
//if(!isset($_SESSION)) {
    session_start();
//}

require_once $_SERVER['DOCUMENT_ROOT'] . "/config/koneksi.php";

function base_url() {
    $base_url = "https://rasabersama.ansita.cloud/";
    return $base_url;
}

// check if user is logged in
function is_logged_in() {
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Silahkan login terlebih dahulu";
        header("Location: ../index.php");
    }
}


function calculate_rating($recipeId) {  
    global $conn;

    // rating count in table recipe_comment field rating
    $sql = "SELECT SUM(rating) as total_rating FROM recipe_comment WHERE recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();

    $result = $stmt->get_result();
    $totalRating = $result->fetch_assoc();

    $sqlComment = "SELECT COUNT(*) as total_comment FROM recipe_comment WHERE recipe_id = ?";
    $stmtComment = $conn->prepare($sqlComment);
    $stmtComment->bind_param("i", $recipeId);
    $stmtComment->execute();

    $resultComment = $stmtComment->get_result();
    $totalComment = $resultComment->fetch_assoc();

    $averageRating = 0;
    if ($totalRating['total_rating'] > 0) {
        $averageRating = $totalRating['total_rating'] / $totalComment['total_comment'];
    }

    // bulatkan ke angka terdekat
    $averageRating = round($averageRating);

    // loop for display rating in star icon
    $rating = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $averageRating) {
            $rating .= '<i style="cursor:pointer;" class="bi-star-fill text-warning send_rating" data-rating="' . $i . '"></i>';
        } else {
            $rating .= '<i style="cursor:pointer;" class="bi-star text-warning send_rating"  data-rating="' . $i . '"></i>';
        }
    }

    return $rating . ' (' . $totalComment['total_comment'] . ')';


}

function your_rating($recipeId) {
    global $conn;

    $userId = $_SESSION['id'];

    $sql = "SELECT * FROM recipe_comment WHERE user_id = ? AND recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $recipeId);
    $stmt->execute();

    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();
    
    $yourRating = 0;
    if ($result->num_rows > 0) {
        $yourRating = $comment['rating'];
    }

    $rating = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $yourRating) {
            $rating .= '<i style="cursor:pointer;" class="bi-star-fill text-warning send_rating" data-recipeid="'.$recipeId.'" data-rating="' . $i . '"></i>';
        } else {
            $rating .= '<i style="cursor:pointer;" class="bi-star text-warning send_rating" data-recipeid="'.$recipeId.'"  data-rating="' . $i . '"></i>';
        }
    }

    $totalCommentsql = "SELECT COUNT(*) as total_comment FROM recipe_comment WHERE recipe_id = ?";
    $stmtComment = $conn->prepare($totalCommentsql);
    $stmtComment->bind_param("i", $recipeId);
    $stmtComment->execute();

    $resultComment = $stmtComment->get_result();
    $totalComment = $resultComment->fetch_assoc();


    return $rating . ' (' . $totalComment['total_comment'] . ')';

}

function calculate_comment($recipeId) {
    global $conn;

    $sqlComment = "SELECT COUNT(*) as total_comment FROM recipe_comment WHERE recipe_id = ?";
    $stmtComment = $conn->prepare($sqlComment);
    $stmtComment->bind_param("i", $recipeId);
    $stmtComment->execute();

    $resultComment = $stmtComment->get_result();
    $totalComment = $resultComment->fetch_assoc();

    return $totalComment['total_comment'];
}

function calculate_like($recipeId) {
    global $conn;

    $sqlLike = "SELECT COUNT(*) as total_like FROM recipe_likes WHERE recipe_id = ?";
    $stmtLike = $conn->prepare($sqlLike);
    $stmtLike->bind_param("i", $recipeId);
    $stmtLike->execute();

    $resultLike = $stmtLike->get_result();
    $totalLike = $resultLike->fetch_assoc();

    return $totalLike['total_like'];
}

function limit_description($description) {
    return strlen($description) > 50 ? substr($description, 0, 50) . '...' : $description;
}

function get_category($categoryId) {
    global $conn;

    $sql = "SELECT * FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();

    $result = $stmt->get_result();
    $category = $result->fetch_assoc();

    return $category;
}

function get_bahan($recipeId) {
    global $conn;

    $sql = "SELECT * FROM recipe_ingredients WHERE recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();

    $result = $stmt->get_result();
    $bahan = $result->fetch_all(MYSQLI_ASSOC);

    return $bahan;
}

function get_direction($recipeId) {
    global $conn;

    $sql = "SELECT * FROM recipe_directions WHERE recipe_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();

    $result = $stmt->get_result();
    $direction = $result->fetch_all(MYSQLI_ASSOC);

    return $direction;
}

function is_like($recipeId) {
    // if user is not logged in
    if (!isset($_SESSION['id'])) {
        return false;
    }

    global $conn;
    $userId = $_SESSION['id'];

    $sql = "SELECT * FROM recipe_likes WHERE recipe_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $recipeId, $userId);
    $stmt->execute();

    $result = $stmt->get_result();
    $like = $result->fetch_assoc();

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
