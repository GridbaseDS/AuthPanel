<h2 style="color: green;">Status: Activo</h2>
<p>Tu plugin está activado y recibiendo actualizaciones de forma remota.</p>

<form method="post" action="">
    <input type="hidden" name="gridbase_license_nonce" value="%%NONCE%%">
    <input type="hidden" name="_wpnonce" value="%%NONCE%%">
    <input type="hidden" name="gridbase_license_action" value="deactivate">
    <table class="form-table">
        <tr>
            <th scope="row">Clave de Licencia</th>
            <td>
                <input type="password" value="{{ $masked_key }}" class="regular-text" disabled>
            </td>
        </tr>
    </table>
    <p class="submit">
        <button type="submit" class="button button-secondary">Desactivar Licencia Localmente</button>
    </p>
</form>
