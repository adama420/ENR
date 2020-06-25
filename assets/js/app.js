import React from 'react';
import ReactDOM from 'react-dom';
import Navbar from "./components/Navbar";
import HomePage from "./pages/HomePage";
import {HashRouter, Switch, Route} from "react-router-dom";
import DevicesPage from "./pages/DevicesPage";
import LoginPage from "./pages/LoginPage";
import AlarmsPage from "./pages/AlarmsPage";



// any CSS you import will output into a single css file (app.css in this case)
require("../css/app.css");

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';


const App = () => {
    return (
        <HashRouter>
            <Navbar/>
            <main className="container pt-5">
                <Switch>
                    <Route path="/alarmes" component={AlarmsPage} />
                    <Route path="/login" component={LoginPage} />
                    <Route path="/appareils" component={DevicesPage} />
                    <Route path="/" component={HomePage} />
                </Switch>
            </main>
        </HashRouter>
    );
};

const rootElement = document.querySelector('#app');
ReactDOM.render(<App/>, rootElement);