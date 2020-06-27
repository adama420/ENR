import React, {useEffect, useState} from "react";
import axios from "axios";



const MaintenancesPage = props => {

    const url = window.location.href;
    const modele = url.substring(url.lastIndexOf('/') + 1);



    const [maintenances, setMaintenances] = useState([]);

    useEffect(() => {


        axios.get('http://localhost:8000/api/maintenances?device=', {
            params: {
                device: modele
            }
        })
            .then(response => response.data['hydra:member'])
            .then(data => setMaintenances(data))
            .catch(error => console.log(error.response));
    },[]);

console.log(maintenances);




    return (
        <>
            <h1>hello</h1>
            <div className="row">
                {maintenances.map( maintenance =>

                    <div className="card col-4">
                        <div className="card-body">
                            <p className="card-text">
                                {maintenance.nameStep}
                            </p>
                        </div>
                    </div>
                )}
            </div>
        </>
    );
};

export default MaintenancesPage;