import React, {useEffect, useState} from "react";
import axios from "axios";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Accordion from "react-bootstrap/Accordion";
import Card from "react-bootstrap/Card";
import renderMarkup from "react-render-markup";



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
    console.log(alarms);



    return (
        <>

            <Container fluid className="text-center">
                <h1>Liste des alarmes:</h1>
                {alarms.map( alarm =>
                    <Row className="my-2" key={alarm.id}>
                        <Col xs={{span: 12, offset:0}} md={{span: 6, offset:3}}>
                            <Accordion>
                                <Card className="text-center pb-3">
                                    <Card.Header className="text-primary" style={{fontWeight: 'bold'}}>
                                        <Accordion.Toggle as={Card.Header} variant="link" eventKey={alarm.id}>
                                            {alarm.title}
                                        </Accordion.Toggle>
                                    </Card.Header>
                                    <Accordion.Collapse eventKey={alarm.id}>
                                        <Card.Body>
                                            <Card.Subtitle className="py-4" style={{fontWeight: 'bold', color:'blue'}}>{alarm.description}</Card.Subtitle>
                                            <Card.Text>{renderMarkup(alarm.explanation)}</Card.Text>
                                            {alarm.imageName.length > 4 &&
                                            <Card.Img style={{objectFit: 'contain'}} src={"images/alarms/" + alarm.imageName}/>
                                            }
                                        </Card.Body>
                                    </Accordion.Collapse>
                                </Card>
                            </Accordion>
                        </Col>
                    </Row>
                )}

            </Container>
        </>
    );
};

export default AlarmsPage;