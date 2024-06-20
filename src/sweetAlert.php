<?php

namespace vipBerber;

class sweetAlert {
    public static function showSweetAlert($title, $message, $icon): void
    {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            Swal.fire({
                title: '{$title}',
                text: '{$message}',
                icon: '{$icon}',
                showConfirmButton: true,
                confirmButtonColor: '#f0ff00'
            });
        </script>";
    }
}
