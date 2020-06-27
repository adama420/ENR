import React, {useEffect, useState} from "react";
import axios from "axios";



const AlarmsPage = props => {

    const url = window.location.href;
    const modele = url.substring(url.lastIndexOf('/') + 1);


    const [alarms, setAlarms] = useState([]);
    useEffect(() => {


        axios.get('http://localhost:8000/api/alarms?device=', {
            params: {
                device: modele
            }
        })
            .then(response => response.data['hydra:member'])
            .then(data => setAlarms(data))
            .catch(error => console.log(error.response));
    },[]);

    return (
        <>
            <h1>hello</h1>
            <div className="row">
            {alarms.map( alarm =>
                <div className="card col-4">
                   <div className="card-body">
                       <p className="card-text">
                           {alarm.subtitle}
                       </p>
                   </div>
                </div>
            )}
            </div>
        </>
    );
};

export default AlarmsPage;