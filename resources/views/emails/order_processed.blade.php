<!DOCTYPE html>
<html>

<head>
    <title>Confirmación de Pedido</title>
</head>

<body style="font-family: sans-serif; line-height: 1.6; color: #333;">
    <div style="background-color: #0d6efd; color: white; padding: 20px; text-align: center;">
        <h1>¡Gracias por tu compra! 🚀</h1>
    </div>
    <div style="padding: 20px; border: 1px solid #eee;">
        <p>Hola,</p>
        <p>Tu pedido <strong>#{{ $order->getId() }}</strong> ha sido procesado con éxito.</p>
        <p><strong>Total pagado:</strong> ${{ number_format($order->getTotal(), 2) }}</p>
        <br>
        <p>Saludos,<br>El equipo de Tech Store ⚡</p>
    </div>
</body>

</html>
