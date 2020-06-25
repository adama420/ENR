import React from 'react';

const Navbar = (props) => {
    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-primary">
            <a className="navbar-brand" href="#">ENR App</a>

            <div className="collapse navbar-collapse" id="navbarColor01">
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <a className="nav-link" href="#/appareils">Appareils</a>
                    </li>
                </ul>
                <ul className="navbar-nav ml-auto">
                    <li className="nav-item">
                        <a href="#" className="nav-link">
                            Inscription
                        </a>
                    </li>
                    <li className="nav-item">
                        <a href="#" className="btn btn-success">
                            Connexion
                        </a>
                    </li>
                    <li className="nav-item">
                        <a href="#" className="btn btn-danger">
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    );
};

export default Navbar;