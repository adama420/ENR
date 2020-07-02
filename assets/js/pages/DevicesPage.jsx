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

    };

    const handleTransfert = event => {
        const data = event.currentTarget.value;
        console.log(data);
    }

    const filterdDevices = devices.filter(
        d =>
            d.name.toLowerCase().includes(search.toLowerCase()) ||
            d.reference.includes(search)

    );


    return (
        <>
            <div className="container">
                <h1 className="text-center">Les appareils Edilkamin </h1>
                <div className="form-group">
                    <input type="text" onChange={handleSearch} value={search} className="form-control" placeholder="Chercher un appareil..."/>
                </div>
                <div className="row">

                    {filterdDevices.map(device =>

                        <div key={device.id} className="card col-10 offset-1 col-md-4 offset-md-0">
                            <img className="card-img-top" src={"images/devices/" + device.imageName}/>
                            <div className="card-body text-center">
                                <h4 className="card-title">{device.name}</h4>
                                <p className="card-text">
                                    ref: {device.reference}
                                </p>
                                <div className="text-center"><button className="btn btn-success" onClick={handleTransfert} value={device.id}><a style={{textDecoration:'none', color: 'white'}} href={"#/alarmes/"+ device.id}>Alarmes</a></button></div>
                                <div className="text-center"><button className="btn btn-success my-2" onClick={handleTransfert} value={device.id}><a style={{textDecoration:'none', color: 'white'}} href={"#/maintenances/"+ device.id}>Maintenance</a></button></div>
                                <div className="text-center"><button className="btn btn-success" onClick={handleTransfert} value={device.id}><a style={{textDecoration:'none', color: 'white'}} href={"#/notices/"+ device.id}>Notice</a></button></div>
                            </div>
                        </div>
                    )}
                </div>
            </div>


        </>

    );

};

export default DevicesPage;