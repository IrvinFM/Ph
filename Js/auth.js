export async function verifySession() {
    try {
        const response = await fetch('includes/auth_check.php');
        
        if (!response.ok) {
            throw new Error('Sesión no válida');
        }
        
        return true;
    } catch (error) {
        console.error('Error verifying session:', error);
        Swal.fire('Sesión expirada', 'Por favor inicie sesión nuevamente', 'warning')
            .then(() => {
                window.location.href = 'login.html';
            });
        return false;
    }
}