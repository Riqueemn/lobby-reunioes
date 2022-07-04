<html>
    <script src='https://8x8.vc/external_api.js'></script>
    <script type="text/javascript">
      let api;
    
      const initIframeAPI = () => {
        const domain = '8x8.vc';
        const options = {
          roomName: 'vpaas-magic-cookie-e3d18e07c6b84703a43feca37bc14da3/SampleAppFavourableRewardsUpdateYearly',
          jwt: 'eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InZwYWFzLW1hZ2ljLWNvb2tpZS1lM2QxOGUwN2M2Yjg0NzAzYTQzZmVjYTM3YmMxNGRhMy9lMDdkM2QifQ.eyJhdWQiOiJqaXRzaSIsImNvbnRleHQiOnsidXNlciI6eyJpZCI6ImM1YzIyNzRiLTcxMGUtNDAxNi05MWIwLThiM2QzMDJhMjc2OSIsIm5hbWUiOiJoZW5yaXF1ZSIsImF2YXRhciI6Im15IGF2YXRhciB1cmwiLCJlbWFpbCI6Im15IHVzZXIgZW1haWwiLCJtb2RlcmF0b3IiOiJ0cnVlIn0sImZlYXR1cmVzIjp7ImxpdmVzdHJlYW1pbmciOiJ0cnVlIiwicmVjb3JkaW5nIjoidHJ1ZSIsInRyYW5zY3JpcHRpb24iOiJ0cnVlIiwib3V0Ym91bmQtY2FsbCI6InRydWUifX0sImlzcyI6ImNoYXQiLCJyb29tIjoiKiIsInN1YiI6InZwYWFzLW1hZ2ljLWNvb2tpZS1lM2QxOGUwN2M2Yjg0NzAzYTQzZmVjYTM3YmMxNGRhMyIsImV4cCI6MTY1Njc5NzI3MywibmJmIjoxNjU2Nzg2NDYzLCJpYXQiOjE2NTY3ODY0NzN9.F9-sG18ih6p412evI1k6gjxkuRw9K9S6LMXeO60kIaxA4mERCNfM5NcrL3VOUIil7jftoq9IGgfZetH4ZmSiGBI-Ms9mH1xjvK3gCqRWgv5N10RHekRIP0Jnj9YDSk9rL5kO0rjgpwbDeEKnkNi3CGOa0HG3xafDNHXKfRwtV46mg3A98BoDcZPmkLBTY_MJijb9W5UwZG3HhN9q_o9q5jVRXeh7Ay-yN5uGo4mnq_K7SdmVQRhtvDPxfJBIVpHdwvQRResb3GOiDXjpYpycmg9VT1JesB-yoo_BjwIhXiXkeqA0pNAMvK1NxyR37fC420DscESzcfmn5I6UGo9T7Q',
          width: 700,
          height: 700,
          parentNode: document.querySelector('#meet')
        };
        api = new JitsiMeetExternalAPI(domain, options);
      }
    
      window.onload = () => {
        initIframeAPI();
      }
    </script>
    <body><div id="meet" /></body>
</html>