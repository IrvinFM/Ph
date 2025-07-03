import BranchesManager from './branches.js';
import { verifySession } from './auth.js';

document.addEventListener('DOMContentLoaded', () => {
    // Verificar sesión al cargar
    verifySession().then(isValid => {
        if (isValid) {
            // Inicializar módulos
            const branchesManager = new BranchesManager();
            
          
        } else {
            window.location.href = 'login.html';
        }
    });
});