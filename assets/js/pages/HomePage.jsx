import React from 'react';

const HomePage = (props) => {
    return (
        <div className="jumbotron text-center">
            <h1 className="display-3">Assistant virtuel ENR Distribution</h1>
            <p className="lead">Trouvez les procédures d'entretien, de l'aide à la résolution des mises en alarme ainsi que les notices PDF de tous vous appareils Edilkamin 24h/24 7j/7</p>
                <p className="lead">
                    <a className="btn btn-primary btn-lg" href="#/appareils" role="button">C'est parti !</a>
                </p>
        </div>
    );
};

export default HomePage;