<script src="https://js.stripe.com/v3/"></script>

<script>
    const publicKey = 'pk_test_51J7i1pAYe8iVGfKLzFCascuAj5lygx0BGsjIvpOBS6YWRhQ9mQ7C2oAjgpCMaY9WvarScXt7WrMK1Rw5GhPbaDjQ00aXkVQTiQ';
    var stripe = Stripe(publicKey);
    // 4. 決済ボタンが押下されたら決済画面にリダイレクトする
    function onClick() {
        stripe.redirectToCheckout({
            sessionId: '{{ $session->id }}'
        }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
        });
    }
</script>

<h1>決済フォーム(Checkout)</h1>

<button onclick="onClick()">決済画面へ</button>