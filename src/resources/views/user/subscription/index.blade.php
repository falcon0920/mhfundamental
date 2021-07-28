<script src="https://js.stripe.com/v3/"></script>

<script>
    const publicKey = 'pk_live_51J7i1pAYe8iVGfKL1h9uALfHGzvIGWqPaYWThFdZaE7oCPqMCx2K5fkfW3xy2XzjVghMAsbd5waQZtorZK0cMC6b00bxibzicz';
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