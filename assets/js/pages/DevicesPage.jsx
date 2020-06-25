import React, {useEffect, useState} from 'react';
import axios from "axios";

const DevicesPage = props => {

    const [devices, setDevices] = useState([]);
    const [search, setSearch] = useState("");

    useEffect(() => {
        axios.get("http://localhost:8000/api/devices")
            .then(response => response.data['hydra:member'])
            .then(data => setDevices(data))
            .catch(error => console.log(error.response));
        },[]);

    const handleSearch = event => {
        const value = event.currentTarget.value;
        setSearch(value);
        console.log(devices);

    };

    const filterdDevices = devices.filter(
        d =>
            d.name.toLowerCase().includes(search.toLowerCase()) ||
            d.reference.includes(search)

    );


    return (
        <>
            <div className="container">
                <h1> Liste des Appareils </h1>
                <div className="form-group">
                    <input type="text" onChange={handleSearch} value={search} className="form-control" placeholder="Rechecher ..."/>
                </div>
                <div className="row">

                    {filterdDevices.map(device =>

                        <div key={device.id} className="card col-4">
                            <img className="card-img-top" url={device.image} alt="Card image cap"/>
                            <div className="card-body">
                                <h4 className="card-title">{device.name}</h4>
                                <p className="card-text">
                                    ref: {device.reference}
                                </p>
                            </div>
                        </div>
                    )}
                </div>
            </div>


        </>

    );

};

export default DevicesPage;