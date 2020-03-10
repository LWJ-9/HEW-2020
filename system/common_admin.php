<?php
// 関連ファイルをロード
require_once "common.php";

// セッションの開始
session_start();

// ログイン状態のチェック
$logined_flag = false; // ログイン状態フラグ
if (!isset($ignore_login)) {
    // 認証用変数をsessionから取得
    if (isset($_SESSION["user_name"])) {
        $session_user_name = $_SESSION["user_name"];
        try {
            $stmt = $db->prepare("SELECT * FROM users WHERE name = ? LIMIT 1");
            $stmt->execute(array($session_user_name)); // クエリの実行
            $row_user = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納
            if ($row_user) {
                // 該当のuserレコードがあったらログイン状態にする
                $logined_flag = true;
            }
        } catch (PDOException $e) {
            // エラー発生時
            exit("ログイン状態のチェックに失敗しました");
        }
    }
    
    // ログイン状態でなかったら、ログインページへジャンプ
    if (!$logined_flag) {
        header("Location: login.php");
        exit;
    }
}