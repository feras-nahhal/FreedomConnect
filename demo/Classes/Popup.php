<?php

class Popup {
    private $message;

    // Constructor that accepts the message text
    public function __construct($message) {
        $this->message = $message;
    }

    // Method to display the popup
    public function show() {
        echo '
        <style>
            /* The Modal (background) */
            .modal {
                display: block; /* Always shown */
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            }

            /* Modal Content */
            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                text-align: center;
            }

            /* OK Button */
            .ok-button {
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
                font-size: 16px;
            }

            .ok-button:hover {
                background-color: #45a049;
            }
        </style>

        <div class="modal">
            <div class="modal-content">
                <p>' . htmlspecialchars($this->message) . '</p>
                <button class="ok-button" onclick="closePopup()">OK</button>
            </div>
        </div>

        <script>
            function closePopup() {
                document.querySelector(".modal").style.display = "none";
            }
        </script>
        ';
    }
}
