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

function get_user_submitted_recipe($recipeId) {
    global $conn;

    $sql = "SELECT * FROM recipes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();

    $result = $stmt->get_result();
    $recipe = $result->fetch_assoc();

    $sqlUser = "SELECT * FROM users WHERE id = ?";
    $stmtUser = $conn->prepare($sqlUser);
    $stmtUser->bind_param("i", $recipe['user_id']);
    $stmtUser->execute();

    $resultUser = $stmtUser->get_result();
    $user = $resultUser->fetch_assoc();

    return $user;
}

function get_since_ago($date){
    $time = strtotime($date);
    $current_time = time();
    $time_difference = $current_time - $time;
    $seconds = $time_difference;
    $minutes      = round($seconds / 60);           // value 60 is seconds
    $hours        = round($seconds / 3600);         // value 3600 is 60 minutes * 60 sec
    $days         = round($seconds / 86400);        // value 86400 is 24 hours * 60 minutes * 60 sec
    $weeks        = round($seconds / 604800);       // value 604800 is 7 days * 24 hours * 60 minutes * 60 sec
    $months       = round($seconds / 2629440);      // value 2629440 is (365+365+365+365+366)/5/12 * 24 hours * 60 minutes * 60 sec
    $years        = round($seconds / 31553280);     // value 31553280 is 365+365+365+365+366 * 24 hours * 60 minutes * 60 sec
    if ($seconds <= 60){
        return "Baru saja";
    } else if ($minutes <= 60){
        if ($minutes == 1){
            return "1 menit yang lalu";
        } else {
            return "$minutes menit yang lalu";
        }
    } else if ($hours <= 24){
        if ($hours == 1){
            return "1 jam yang lalu";
        } else {
            return "$hours jam yang lalu";
        }
    } else if ($days <= 7){
        if ($days == 1){
            return "Kemarin";
        } else {
            return "$days hari yang lalu";
        }
    } else if ($weeks <= 4.3){  // 4.3 == 30/7
        if ($weeks == 1){
            return "1 minggu yang lalu";
        } else {
            return "$weeks minggu yang lalu";
        }
    } else if ($months <= 12){
        if ($months == 1){
            return "1 bulan yang lalu";
        } else {
            return "$months bulan yang lalu";
        }
    } else {
        if ($years == 1){
            return "1 tahun yang lalu";
        } else {
            return "$years tahun yang lalu";
        }
    }

}

function get_user_submit_comment($commentId) {
    global $conn;

    $sql = "SELECT * FROM recipe_comment WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $commentId);
    $stmt->execute();

    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();

    $sqlUser = "SELECT * FROM users WHERE id = ?";
    $stmtUser = $conn->prepare($sqlUser);

    $stmtUser->bind_param("i", $comment['user_id']);

    $stmtUser->execute();

    $resultUser = $stmtUser->get_result();

    $user = $resultUser->fetch_assoc();

    return $user;
}
