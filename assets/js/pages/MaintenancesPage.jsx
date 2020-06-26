import React, {useEffect, useState} from "react";
import axios from "axios";



const MaintenancesPage = props => {

    const url = window.location.href;
    const modele = url.substring(url.lastIndexOf('/') + 1);
    console.log(modele);


    const [maintenances, setMaintenances] = useState([]);
    useEffect(() => {


        axios.get('http://localhost:8000/api/devices/', {
            params: {
                id: modele
            }
        })
            .then(response => response.data['hydra:member'][0].maintenances)
            .then(data => setMaintenances(data))
            .catch(error => console.log(error.response));
    },[]);


    return (
        <>
            <h1>hello</h1>
            <div className="row">
                {maintenances.map( maintenance =>

                    <div className="card col-4">
                        <div className="card-body">
                            <p className="card-text">
                                {maintenance}
                            </p>
                        </div>
                    </div>
                )}
            </div>
        </>
    );
};

export default MaintenancesPage;